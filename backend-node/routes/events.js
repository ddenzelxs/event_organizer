const express = require('express');
const router = express.Router();
const controller = require('../controllers/eventsController');
const authenticateToken = require('../middleware/auth');
const authorizeRole = require('../middleware/authorizeRole');

router.get('/', controller.getAll);
router.get('/:id', controller.getById);

router.post('/', authenticateToken, authorizeRole(4), controller.create);
router.put('/:id', authenticateToken, authorizeRole(4), controller.update);
router.delete('/:id', authenticateToken, authorizeRole(4), controller.deleteById);

module.exports = router;