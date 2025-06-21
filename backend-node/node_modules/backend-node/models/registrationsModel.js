const db = require('../database/database');

const getAllRegistrations = async () => {
  const query = `
    SELECT r.*, u.name as user_name, s.name as session_name, e.name
    FROM registrations r
    JOIN users u ON r.user_id = u.id
    JOIN event_sessions s ON s.id = r.id
    JOIN events e ON e.id = s.event_id
  `;
  return db.execute(query);
};

const getRegistrationById = async (id) => {
  const query = 'SELECT * FROM registrations WHERE id = ?';
  return db.execute(query, [id]);
};

const insertRegistration = async (data) => {
  const query = `
    INSERT INTO registrations (user_id, session_id, registered_at, attendance)
    VALUES (?, ?, ?, ?)
  `;
  const values = [data.user_id, data.event_id, data.registered_at, data.attendance || false];
  return db.execute(query, values);
};

const updateRegistration = async (id, data) => {
  const query = `
    UPDATE registrations
    SET user_id = ?, event_id = ?, registered_at = ?, attendance = ?
    WHERE id = ?
  `;
  const values = [data.user_id, data.event_id, data.registered_at, data.attendance, id];
  return db.execute(query, values);
};

const deleteRegistration = async (id) => {
  const query = 'DELETE FROM registrations WHERE id = ?';
  return db.execute(query, [id]);
};

// PATCH attendance (true/false)
const toggleAttendance = async (id, status) => {
  const query = 'UPDATE registrations SET attendance = ? WHERE id = ?';
  return db.execute(query, [status, id]);
};

module.exports = {
  getAllRegistrations,
  getRegistrationById,
  insertRegistration,
  updateRegistration,
  deleteRegistration,
  toggleAttendance
};
