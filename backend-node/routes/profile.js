const express = require('express');
const router = express.Router();
const profileController = require('../controllers/profileController');
const { body } = require('express-validator');

router.get('/', profileController.getProfile);

router.put(
  '/',
  [
    body('name').notEmpty().withMessage('Name is required'),
    body('username').notEmpty().withMessage('Username is required'),
    body('password').optional().isLength({ min: 6 }).withMessage('Min 6 chars'),
  ],
  profileController.updateProfile
);

module.exports = router;
