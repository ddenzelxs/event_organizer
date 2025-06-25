const express = require('express');
const router = express.Router();
const controller = require('../controllers/statisticsController');
const authenticateToken = require('../middleware/auth');
const authorizeRole = require('../middleware/authorizeRole');

router.get('/summary', authenticateToken, authorizeRole(2), controller.getSummary);
router.get('/committee/summary', authenticateToken, authorizeRole(4), controller.getEventCommitteeStats);

module.exports = router;
