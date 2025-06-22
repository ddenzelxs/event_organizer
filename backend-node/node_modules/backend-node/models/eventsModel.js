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
    INSERT INTO events (name, date, location, poster_url, status, managed_by, created_by, created_at, updated_at)
    VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
  `;
  const values = [
    data.name,
    data.date,
    data.location,
    data.poster_url || null,
    data.status,
    data.managed_by || null,
    data.created_by || null
  ];
  return db.execute(query, values);
};

const updateEvent = async (id, data) => {
  const query = `
    UPDATE events
    SET name = ?, date = ?, location = ?, poster_url = ?, status = ?, managed_by = ?, updated_at = NOW()
    WHERE id = ?
  `;
  const values = [
    data.name,
    data.date,
    data.location,
    data.poster_url || null,
    data.status,
    data.managed_by || null,
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
