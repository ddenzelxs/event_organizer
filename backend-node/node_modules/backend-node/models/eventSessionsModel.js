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
    INSERT INTO event_sessions (event_id, name, session_date, session_time, speaker, price, location, max_participants, created_at, updated_at)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
  `;
  const values = [
    data.event_id || null,
    data.name,
    data.session_date,
    data.session_time,
    data.speaker,
    data.price || 0,
    data.location || null,
    data.max_participants || null
  ];
  return db.execute(query, values);
};


const updateSession = async (id, data) => {
  const query = `
    UPDATE event_sessions
    SET event_id = ?, name = ?, session_date = ?, session_time = ?, speaker = ?, price = ?, location = ?, max_participants = ?, updated_at = NOW()
    WHERE id = ?
  `;
  const values = [
    data.event_id || null,
    data.name,
    data.session_date,
    data.session_time,
    data.speaker,
    data.price || 0,
    data.location || null,
    data.max_participants || null,
    id
  ];
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
