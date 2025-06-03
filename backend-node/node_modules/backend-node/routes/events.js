const express = require('express');
const router = express.Router();
const controller = require('../controllers/eventsController');

router.get('/', controller.getAllEvents);
router.get('/:id', controller.getEventById);
router.post('/', controller.createEvent);
router.put('/:id', controller.updateEvent);
router.patch('/:id/toggle-status', controller.toggleEventStatus);

module.exports = router;
