const express = require("express");
const router = express.Router();
const controller = require("../controllers/roleController");

router.get("/", controller.getAll);
router.get("/:id", controller.getById)
router.post("/", controller.createRole);
router.put("/:id", controller.editRoleById);
router.delete("/:id", controller.deleteRoleById);

module.exports = router;
