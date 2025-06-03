const express = require('express');
const router = express.Router();
const controller = require('../controllers/SessionsController');

router.get('/', controller.getAllSessions);
router.get('/:id', controller.getSessionById);
router.post('/', controller.createSession);
router.put('/:id', controller.updateSession);

module.exports = router;
