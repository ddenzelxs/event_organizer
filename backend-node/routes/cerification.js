const express = require('express');
const router = express.Router();
const controller = require('../controllers/certificatesController');

router.get('/', controller.getAll);
router.get('/:id', controller.getById);
router.post('/', controller.create);
router.delete('/:id', controller.deleteById);

module.exports = router;
