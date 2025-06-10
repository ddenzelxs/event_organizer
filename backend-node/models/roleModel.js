const db = require('../database/database')

const getAllRole = async() => {
    const query = `
    SELECT * FROM role`;
    return db.execute(query)
}

const insertRole = async (nama_role) => {
  const query = "INSERT INTO role (nama_role) VALUES (?)";
  return dbPool.execute(query, [nama_role]);
};

const updateRole = async (id, nama_role) => {
  const query = "UPDATE role SET nama_role = ? WHERE id = ?";
  return dbPool.execute(query, [nama_role, id]);
};

const deleteRole = async (id) => {
  const query = "DELETE FROM role WHERE id = ?";
  return dbPool.execute(query, [id]);
};

module.exports = {
    getAllRole,
    insertRole,
    updateRole,
    deleteRole
};