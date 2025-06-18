const {
  getAllRegistrations, getRegistrationById, insertRegistration, updateRegistration, deleteRegistration, toggleAttendance} = require('../models/registrationsModel');

const getAll = async (req, res) => {
  try {
    const [registrations] = await getAllRegistrations();
    res.json({ message: 'GET all registrations success', data: registrations });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error });
  }
};

const getById = async (req, res) => {
  try {
    const [registration] = await getRegistrationById(req.params.id);
    res.json({ message: 'GET registration by ID success', data: registration });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error });
  }
};

const create = async (req, res) => {
  try {
    await insertRegistration(req.body);
    res.status(201).json({ message: 'CREATE registration success' });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error });
  }
};

const update = async (req, res) => {
  try {
    await updateRegistration(req.params.id, req.body);
    res.json({ message: 'UPDATE registration success' });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error });
  }
};

const deleteById = async (req, res) => {
  try {
    await deleteRegistration(req.params.id);
    res.json({ message: 'DELETE registration success' });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error });
  }
};

module.exports = {
  getAll,
  getById,
  create,
  update,
  deleteById,
  toggleAttendance
};