const express = require('express');
const router = express.Router();
const controller = require('../controllers/usersController');
const authenticateToken = require('../middleware/auth');
const authorizeRole = require('../middleware/authorizeRole');

router.get('/', authenticateToken, authorizeRole(2), controller.getAll);
router.get('/:id', authenticateToken, authorizeRole(1,2), controller.getById);
router.get('/role/:role_id', authenticateToken, authorizeRole(2), controller.getByRole);
router.post('/', controller.create);
router.put('/:id', authenticateToken, authorizeRole(1,2), controller.update);

module.exports = router;