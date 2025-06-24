const express = require('express');
const router = express.Router();
const controller = require('../controllers/registrationsController');
const authenticateToken = require('../middleware/auth');
const authorizeRole = require('../middleware/authorizeRole');

router.get('/', authenticateToken, authorizeRole(1,3,4), controller.getAll);
router.get('/:id', authenticateToken, authorizeRole(1,3,4), controller.getById);

router.post('/', authenticateToken, authorizeRole(1), controller.create)
router.put('/:id', authenticateToken, authorizeRole(1), controller.update);
router.delete('/:id', authenticateToken, authorizeRole(1), controller.deleteById);
router.patch('/:id/attendance', authenticateToken, authorizeRole(3,4), controller.toggleAttendanceById);

module.exports = router;