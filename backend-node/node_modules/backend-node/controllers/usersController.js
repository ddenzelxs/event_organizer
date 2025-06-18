const {
  findAllUsers, findUsersByRole, insertUser, updateUser} = require('../models/usersModel');

const getAll = async (req, res) => {
  try {
    const [users] = await findAllUsers();
    res.json({ message: 'GET all users success', data: users });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error.message });
  }
};

const getByRole = async (req, res) => {
  try {
    const [users] = await findUsersByRole(req.params.role_id);
    res.json({ message: 'GET users by role success', data: users });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error.message });
  }
};

const create = async (req, res) => {
  try {
    await insertUser(req.body);
    res.status(201).json({ message: 'CREATE user success' });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error.message });
  }
};

const update = async (req, res) => {
  try {
    await updateUser(req.params.id, req.body);
    res.json({ message: 'UPDATE user success' });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error.message });
  }
};

module.exports = {
  getAll,
  getByRole,
  create,
  update
};
