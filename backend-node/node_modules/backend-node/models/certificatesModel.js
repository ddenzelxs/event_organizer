const db = require('../database/database');

const getAllCertificates = async () => {
  const query = `
    SELECT certificates.*, registrations.*, event_sessions.*, events.*, users.*
    FROM certificates 
    JOIN registrations ON certificates.regist_id = registrations.id 
    JOIN event_sessions ON registrations.session_id = event_sessions.id 
    JOIN events ON event_sessions.event_id = events.id
    JOIN users ON registrations.user_id = users.id
  `;
  return db.execute(query);
};

const getCertificateById = async (id) => {
  const query = `
    SELECT c.*, r.*, s.*, e.*, u.*
    FROM certificates c
    JOIN registrations r ON c.regist_id = r.id 
    JOIN event_sessions s ON r.session_id = s.id 
    JOIN events e ON s.event_id = e.id
    JOIN users u ON r.user_id = u.id
    WHERE c.id = ?
  `;
  return db.execute(query, [id]);
};


const insertCertificate = async (regist_id, certificate_url) => {
  const query = `
    INSERT INTO certificates (regist_id, issued_at, certificate_url)
    VALUES (?, NOW(), ?)
  `;
  return db.execute(query, [regist_id, certificate_url]);
};

const deleteCertificate = async (id) => {
  const query = `DELETE FROM certificates WHERE id = ?`;
  return db.execute(query, [id]);
};

module.exports = {
  getAllCertificates,
  getCertificateById,
  insertCertificate,
  deleteCertificate,
};
