const {getAllEvents, getEventById, createEvent, updateEvent, deleteEvent, detailEvent} = require('../models/eventsModel');

const getAll = async (req, res) => {
  try {
    const [events] = await getAllEvents();
    res.json({ message: 'GET all events success', data: events });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error.message });
  }
};

const getById = async (req, res) => {
  try {
    const [event] = await getEventById(req.params.id);
    res.json({ message: 'GET event by ID success', data: event[0] });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error.message });
  }
};

const create = async (req, res) => {
  try {
    await createEvent(req.body);
    res.status(201).json({ message: 'CREATE event success' });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error.message });
  }
};

const update = async (req, res) => {
  try {
    await updateEvent(req.params.id, req.body);
    res.json({ message: 'UPDATE event success' });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error.message });
  }
};

const deleteById = async (req, res) => {
  try {
    await deleteEvent(req.params.id);
    res.json({ message: 'DELETE event success' });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error.message });
  }
};

const getDetail = async (req, res) => {
  try {
    const [events] = await detailEvent(req.params.id);
    res.json({ message: 'GET Detail events success', data: events });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error.message});
  }
}

module.exports = {
  getAll,
  getById,
  create,
  update,
  deleteById,
  getDetail
};