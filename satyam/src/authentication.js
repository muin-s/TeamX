'use strict';

const User = require('../models/user.model');
const Recruiter = require('../models/recruiter.model');
const Applicant = require('../models/applicant.model');
const jwt = require('jsonwebtoken');
const config = require('../config');
const httpStatus = require('http-status');

exports.register = async (req, res, next) => {
  try {
    const userData = req.body;
    const user = await new User(userData).save();
    const userDetails = await (user.role === 'applicant' ? new Applicant(userData) : new Recruiter(userData)).save();
    
    const response = {
      account: user.transform(),
      details: userDetails.transform()
    };

    res.status(httpStatus.CREATED).send(response);
  } catch (error) {
    return next(User.checkDuplicateEmailError(error));
  }
};

exports.login = async (req, res, next) => {
  try {
    const user = await User.findAndGenerateToken(req.body);
    const payload = { sub: user.id, role: user.role };
    const token = jwt.sign(payload, config.secret);
    
    res.json({ message: 'OK', token });
  } catch (error) {
    next(error);
  }
};
