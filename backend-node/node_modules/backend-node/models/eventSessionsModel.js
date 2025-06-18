const db = require('../database/database');

const getAllSessions = async () => {
  const query = 'SELECT * FROM event_sessions';
  return db.execute(query);
};

const getSessionById = async (id) => {
  const query = 'SELECT * FROM event_sessions WHERE id = ?';
  return db.execute(query, [id]);
};

const insertSession = async (data) => {
  const query = `
    INSERT INTO event_sessions (event_id, name, session_date, session_time, speaker, location, max_participants)
    VALUES (?, ?, ?, ?, ?, ?, ?)
  `;
  const values = [data.event_id, data.name, data.session_date, data.session_time, data.speaker, data.location, data.max_participants];
  return db.execute(query, values);
};

const updateSession = async (id, data) => {
  const query = `
    UPDATE event_sessions
    SET event_id = ?, name = ?, session_date = ?, session_time = ?, speaker = ?, location = ?, max_participants = ?
    WHERE id = ?
  `;
  const values = [data.event_id, data.name, data.session_date, data.session_time, data.speaker, data.location, data.max_participants, id];
  return db.execute(query, values);
};

const deleteSession = async (id) => {
  const query = 'DELETE FROM event_sessions WHERE id = ?';
  return db.execute(query, [id]);
};

module.exports = {
  getAllSessions,
  getSessionById,
  insertSession,
  updateSession,
  deleteSession
};
