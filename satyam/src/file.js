'use strict';

const httpStatus = require('http-status');
const APIError = require('../utils/APIError');

exports.upload = async (req, res, next) => {
  try {
    if (!req.files) throw new APIError('File is not received');

    const response = { payLoad: req.files.map(element => element.key) };
    res.status(httpStatus.CREATED).send(response);
  } catch (error) {
    next(error);
  }
};
