const db = require('../database/database');

const getAllRegistrations = async () => {
  const query = `
    SELECT r.*, u.name as user_name, e.name as event_name
    FROM registrations r
    JOIN user u ON r.user_id = u.username
    JOIN events e ON r.event_id = e.id
  `;
  return db.execute(query);
};

const getRegistrationById = async (id) => {
  const query = 'SELECT * FROM registrations WHERE id = ?';
  return db.execute(query, [id]);
};

const insertRegistration = async (data) => {
  const query = `
    INSERT INTO registrations (user_id, event_id, registered_at, attendance)
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
