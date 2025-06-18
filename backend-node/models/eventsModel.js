const db = require('../database/database'); // koneksi mysql2.promise()

const getAllEvents = async () => {
  const query = 'SELECT * FROM events';
  return db.execute(query);
};

const getEventById = async (id) => {
  const query = 'SELECT * FROM events WHERE id = ?';
  return db.execute(query, [id]);
};

const createEvent = async (data) => {
  const query = `
    INSERT INTO events (title, description, date, location, created_by, managed_by, poster)
    VALUES (?, ?, ?, ?, ?, ?, ?)`;
  const values = [
    data.title,
    data.description,
    data.date,
    data.location,
    data.created_by,
    data.managed_by,
    data.poster
  ];
  return db.execute(query, values);
};

const updateEvent = async (id, data) => {
  const query = `
    UPDATE events SET title = ?, description = ?, date = ?, location = ?, managed_by = ?, poster = ?
    WHERE id = ?`;
  const values = [
    data.title,
    data.description,
    data.date,
    data.location,
    data.managed_by,
    data.poster,
    id
  ];
  return db.execute(query, values);
};

const deleteEvent = async (id) => {
  const query = 'DELETE FROM events WHERE id = ?';
  return db.execute(query, [id]);
};

module.exports = {
  getAllEvents,
  getEventById,
  createEvent,
  updateEvent,
  deleteEvent
};
