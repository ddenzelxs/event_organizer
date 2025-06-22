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
    INSERT INTO registrations (user_id, session_id, registered_at, attendance_status)
    VALUES (?, ?, ?, ?)
  `;
  const values = [data.user_id, data.session_id, data.registered_at, data.attendance_status || false];
  return db.execute(query, values);
};

const updateRegistration = async (id, data) => {
  const query = `
    UPDATE registrations
    SET user_id = ?, session_id = ?, registered_at = ?, attendance_status = ?
    WHERE id = ?
  `;
  const values = [data.user_id, data.session_id, data.registered_at, data.attendance_status, id];
  return db.execute(query, values);
};

const deleteRegistration = async (id) => {
  const query = 'DELETE FROM registrations WHERE id = ?';
  return db.execute(query, [id]);
};

const toggleAttendance = async (id, status) => {
  const query = 'UPDATE registrations SET attendance_status = ? WHERE id = ?';
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
