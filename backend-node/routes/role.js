const express = require("express");
const router = express.Router();
const controller = require("../controllers/roleController");
const authenticateToken = require('../middleware/auth');
const authorizeRole = require('../middleware/authorize');

router.get("/", authenticateToken, authorizeRole(2), controller.getAll);
router.get("/:id",authenticateToken, authorizeRole(2), controller.getById)
router.post("/", authenticateToken, authorizeRole(2), controller.createRole);
router.put("/:id", authenticateToken, authorizeRole(2), controller.editRoleById);
router.delete("/:id", authenticateToken, authorizeRole(2), controller.deleteRoleById);

module.exports = router;
