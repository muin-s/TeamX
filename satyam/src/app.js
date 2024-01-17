'use strict';

const httpStatus = require('http-status');
const sql = require('./../services/sql');
const mongoose = require('mongoose');
const APIError = require('../utils/APIError');
const Job = require('../models/job.model');
const Applicant = require('../models/applicant.model');
const Application = require('../models/application.model');

exports.unsave = async (req, res, next) => {
  try {
    const jobId = req.params.jobId;
    if (!mongoose.Types.ObjectId.isValid(jobId)) throw new APIError(`Invalid jobId`, httpStatus.BAD_REQUEST);

    const saveJobPointers = { job_id: jobId, applicant_id: req.user._id };
    const currentValues = await sql.query(`DELETE FROM saved_job WHERE job_id = '${saveJobPointers.job_id}' AND applicant_id = '${saveJobPointers.applicant_id}'`);

    const response = { payLoad: {}, message: currentValues.affectedRows >= 1 ? 'SUCCESS' : 'FAILED' };
    res.status(httpStatus.OK).send(response);
  } catch (error) {
    next(error);
  }
};

exports.fetchSavedCount = async (req, res, next) => {
  try {
    const savedJobs = await sql.query(`SELECT * FROM saved_job WHERE applicant_id = '${req.user._id}'`);
    const response = { payLoad: savedJobs.length };
    res.status(httpStatus.OK).send(response);
  } catch (error) {
    next(error);
  }
};

exports.getApplicationDetails = async (req, res, next) => {
  try {
    const jobId = req.params.jobId;
    if (!mongoose.Types.ObjectId.isValid(jobId)) throw new APIError(`Invalid jobId`, httpStatus.BAD_REQUEST);

    const response = { payLoad: [] };
    const ObjectID = mongoose.Types.ObjectId;
    const query = { 'jobId': new ObjectID(jobId) };
    const applications = await Application.find(query);

    for (let index = 0; index < applications.length; index++) {
      const applicantId = applications[index]['applicantId'];
      const applicant = await Applicant.findOne({ id: applicantId }).exec();
      const convertedApplicationJSON = JSON.parse(JSON.stringify(applications[index]));
      convertedApplicationJSON.profile_image = applicant.profile_image;
      response.payLoad.push(convertedApplicationJSON);
    }

    res.status(httpStatus.OK).send(response);
  } catch (error) {
    next(error);
  }
};

exports.fetchSaved = async (req, res, next) => {
  try {
    const response = { payLoad: [] };
    const savedJobs = await sql.query(`SELECT * FROM saved_job WHERE applicant_id = '${req.user._id}'`);

    for (let index = 0; index < savedJobs.length; index++) {
      const element = savedJobs[index];
      const job = await Job.findById(element.job_id).exec();
      response.payLoad.push(job);
    }

    res.status(httpStatus.OK).send(response);
  } catch (error) {
    next(error);
  }
};

// ... (remaining functions, with similar modifications)

exports.easyApply = async (req, res, next) => {
  try {
    const jobId = req.params.jobId;
    if (!mongoose.Types.ObjectId.isValid(jobId)) throw new APIError(`Invalid jobId`, httpStatus.BAD_REQUEST);
    if (!req.body.phone && !req.body.email && !req.body.resume) throw new APIError(`Input data missing phone, email and resume required`, httpStatus.BAD_REQUEST);

    const user = await Applicant.findOne({ id: req.user._id }).exec();
    const applicationData = {
      'name': user.name,
      'email': req.body.email,
      'phone': req.body.phone,
      'address': user.address,
      'resume': req.body.resume,
      'source': 'Linkedin',
      'diversity': 'AUTO',
      'sponsorship': 'AUTO',
      'disability': 'AUTO'
    };
    applicationData.jobId = jobId;

    const jobData = await Job.findById(jobId).exec();
    if (!jobData) throw new APIError(`Invalid jobId`, httpStatus.INTERNAL_SERVER_ERROR);

    applicationData.recruiterId = jobData.recruiter;
    const application = new Application(applicationData);
    const savedApplication = await application.save();

    if (!savedApplication) throw new APIError(`Job not created`, httpStatus.INTERNAL_SERVER_ERROR);

    const applicationPointers = { 'job_id': savedApplication.jobId, 'applicant_id': savedApplication.applicantId, 'recruiter_id': savedApplication.recruiterId, 'application_id': savedApplication._id };
    await sql.query('INSERT INTO job_application SET ?', applicationPointers);
    await deleteIncompleteApplication(applicationPointers.applicant_id, applicationPointers.job_id);

    res.status(httpStatus.OK).send({ payLoad: savedApplication });
  } catch (error) {
    console.error(error);
    next(error);
  }
};

const deleteIncompleteApplication = async (applicantId, jobId) => {
  await sql.query(`DELETE FROM incomplete_application WHERE userId = '${applicantId}' AND jobId = '${jobId}'`);
  await sql.query(`DELETE FROM saved_job WHERE applicant_id = '${applicantId}' AND job_id = '${jobId}'`);
};
