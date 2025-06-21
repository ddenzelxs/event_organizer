const db = require('../database/database');

const getAllCertificates = async () => {
  const query = `
    SELECT c.*, r.user_id, r.event_id, e.name AS event_name, u.name AS user_name
    FROM certificates c
    JOIN registrations r ON c.registration_id = r.id
    JOIN user u ON r.user_id = u.username
    JOIN events e ON r.event_id = e.id
  `;
  return db.execute(query);
};

const getCertificateById = async (id) => {
  const query = `
    SELECT c.*, r.user_id, r.event_id
    FROM certificates c
    JOIN registrations r ON c.registration_id = r.id
    WHERE c.id = ?
  `;
  return db.execute(query, [id]);
};

const insertCertificate = async (registration_id, file_path) => {
  const query = `
    INSERT INTO certificates (registration_id, issued_at, file_path)
    VALUES (?, NOW(), ?)
  `;
  return db.execute(query, [registration_id, file_path]);
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
