'use strict';

const httpStatus = require('http-status');
const sql = require('./../services/sql');
const mongoose = require('mongoose');
// const APIError = require('../utils/APIError');
const Job = require('../models/job.model');
// const Application = require('../models/application.model');
// router.get('/dashboard', auth(), usersController.dashboard)

exports.generateDashboardData = async (req, res, next) => {
  try {
    const response = { payLoad: {}, message: '' };

    if (req.user.role === 'applicant') {
      // Applicant dashboard
      response.payLoad = {
        profileViewGraph: await profileViewGraph(req.user._id),
        appliedCount: await appliedCount(req.user._id),
        savedCount: await savedCount(req.user._id),
        viewedCount: await viewedCount(req.user._id)
      };
    } else {
      // Recruiter dashboard
      const recruiterId = req.user._id;
      const savedCountValue = await savedCountRecruiter(recruiterId);
      const incompleteCountValue = await incompleteCountRecruiter(recruiterId);

      response.payLoad = {
        hotJobGraph: await hotJobGraph(recruiterId),
        coldJobGraph: await coldJobGraph(recruiterId),
        cityHotJobGraph: await getCityHotJobGraph(recruiterId),
        clickOnJobGraph: await clickOnJobGraph(recruiterId),
        savedCount: savedCountValue,
        incompleteCount: incompleteCountValue,
        totalCount: savedCountValue + incompleteCountValue
      };
    }

    res.status(httpStatus.OK).send(response);
  } catch (error) {
    next(error);
  }
};

const getCityHotJobGraph = async (recruiterId) => {
  const ObjectID = mongoose.Types.ObjectId;
  const query = { 'recruiter': new ObjectID(recruiterId) };

  const jobsOfRecruiter = await Job.find(query);
  const result = {};

  for (let index = 0; index < jobsOfRecruiter.length; index++) {
    const job = jobsOfRecruiter[index];
    const job_id = job._id;
    const job_title = job.title;
    const noOfApplications = await sql.query(`SELECT COUNT(*) as count FROM job_application WHERE job_id = '${job_id}'`);

    if (result.hasOwnProperty(job.address.city)) {
      result[job.address.city].push([job_id, job_title, noOfApplications[0].count]);
    } else {
      result[job.address.city] = [[job_id, job_title, noOfApplications[0].count]];
    }
  }

  function Comparator(a, b) {
    if (a[2] < b[2]) return 1;
    if (a[2] > b[2]) return -1;
    return 0;
  }

  for (let key in result) {
    result[key] = result[key].sort(Comparator);
  }

  return result;
};

// ... (remaining functions with similar modifications)
