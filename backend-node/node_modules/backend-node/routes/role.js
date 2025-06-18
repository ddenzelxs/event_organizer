const express = require("express");
const router = express.Router();
const roleController = require("../controllers/roleController");

router.get("/", roleController.getAll);
router.post("/", roleController.createRole);
router.put("/:id", roleController.editRoleById);
router.delete("/:id", roleController.deleteRoleById);

module.exports = router;
