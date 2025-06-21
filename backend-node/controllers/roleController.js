const { getAllRole, getRoleById, insertRole, updateRole, deleteRole } = require("../models/roleModel");

const getAll = async (req, res) => {
  try {
    const [roles] = await getAllRole();
    res.json({
      message: "GET all roles success",
      data: roles,
    });
  } catch (error) {
    res.status(500).json({
      message: "Server Error",
      serverMessage: error,
    });
  }
};

const getById = async (req, res) => {
  try {
    const [roles] = await getRoleById(req.params.id);
    res.json({ message: 'GET role by ID success', data: roles });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error });
  }
};

const createRole = async (req, res) => {
  const { nama_role } = req.body;
  try {
    await insertRole(nama_role);
    res.status(201).json({
      message: "CREATE new Role success",
    });
  } catch (error) {
    res.status(500).json({
      message: "Server Error",
      serverMessage: error,
    });
  }
};

const editRoleById = async (req, res) => {
  const id = req.params.id;
  const { nama_role } = req.body;
  try {
    await updateRole(id, nama_role);
    res.status(200).json({
      message: "Update Role success",
    });
  } catch (error) {
    res.status(500).json({
      message: "Server Error",
      serverMessage: error,
    });
  }
};

const deleteRoleById = async (req, res) => {
  const id = req.params.id;
  try {
    await deleteRole(id);
    res.json({
      message: "Delete Role success",
    });
  } catch (error) {
    res.status(500).json({
      message: "Server Error",
      serverMessage: error,
    });
  }
};

module.exports = {
  getAll,
  getById,
  createRole,
  editRoleById,
  deleteRoleById,
};