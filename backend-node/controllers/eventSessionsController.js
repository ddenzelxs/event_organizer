const {
  getAllSessions, getSessionById, insertSession, updateSession, deleteSession} = require('../models/eventSessionsModel');

const getAll = async (req, res) => {
  try {
    const [sessions] = await getAllSessions();
    res.json({ message: 'GET all sessions success', data: sessions });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error });
  }
};

const getById = async (req, res) => {
  try {
    const [session] = await getSessionById(req.params.id);
    res.json({ message: 'GET session by ID success', data: session });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error });
  }
};

const create = async (req, res) => {
  try {
    await insertSession(req.body);
    res.status(201).json({ message: 'CREATE session success' });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error });
  }
};

const update = async (req, res) => {
  try {
    await updateSession(req.params.id, req.body);
    res.json({ message: 'UPDATE session success' });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error });
  }
};

const deleteById = async (req, res) => {
  try {
    await deleteSession(req.params.id);
    res.json({ message: 'DELETE session success' });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error });
  }
};

module.exports = {
  getAll,
  getById,
  create,
  update,
  deleteById
};