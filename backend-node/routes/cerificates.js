const express = require('express');
const router = express.Router();
const controller = require('../controllers/certificatesController');
const authenticateToken = require('../middleware/auth');
const authorizeRole = require('../middleware/authorize');

router.get('/', authenticateToken, authorizeRole(1, 3, 4), controller.getAll);
router.get('/:id', authenticateToken, authorizeRole(1, 3, 4), controller.getById);

router.post('/', authenticateToken, authorizeRole(4), controller.create);
router.delete('/:id', authenticateToken, authorizeRole(4), controller.deleteById);

module.exports = router;
