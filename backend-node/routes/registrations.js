const express = require('express');
const router = express.Router();
const controller = require('../controllers/registrationsController');

router.get('/', controller.getAll);
router.post('/', controller.getById);
router.put('/:id', controller.update);
router.delete('/:id', controller.deleteById);

module.exports = router;
