const express = require('express');
const router = express.Router();
const controller = require('../controllers/usersController');

router.get('/by-role/:role_id', controller.getUsersByRole);


module.exports = router;
    