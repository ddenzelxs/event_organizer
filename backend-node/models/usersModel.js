const db = require('../database/database');
const bcrypt = require('bcryptjs');

// Ambil semua user
const getAllUsers = async () => {
    const query = `
        SELECT users.*
        FROM users
    `;
    return db.execute(query);
};

// Ambil user berdasarkan ID
const getUserById = async (id) => {
    const query = `
        SELECT * FROM users WHERE id = ?
    `;
    return db.execute(query, [id]);
};

// Ambil user berdasarkan role
const getUsersByRole = async (role_id) => {
    const query = `
        SELECT users.name, users.email, role.nama_role
        FROM users
        JOIN role ON users.role_id = role.id
        WHERE users.role_id = ?
    `;
    return db.execute(query, [role_id]);
};

// Tambahkan user baru
const insertUser = async (data) => {
    const hashedPassword = await bcrypt.hash(data.password, 8);
    const query = `
        INSERT INTO users (name, email, password, role_id, created_at, updated_at)
        VALUES (?, ?, ?, ?, NOW(), NOW())
    `;
    return db.execute(query, [data.name, data.email, hashedPassword, data.role_id]);
};

// Update user berdasarkan ID
const updateUser = async (id, data) => {
    let query = `
        UPDATE users
        SET name = ?, email = ?, role_id = ?, updated_at = NOW()
    `;
    const params = [data.name, data.email, data.role_id];

    if (data.password && data.password.trim() !== '') {
        const hashedPassword = await bcrypt.hash(data.password, 8);
        query += `, password = ?`;
        params.push(hashedPassword);
    }

    query += ` WHERE id = ?`;
    params.push(id);

    return db.execute(query, params);
};

// Ambil user berdasarkan username
const getUserByUsername = async (username) => {
    const query = `
        SELECT * FROM users WHERE name = ?
    `;
    return db.execute(query, [username]);
};

// Ambil user berdasarkan username ATAU email
const getUserByUsernameOrEmail = async (identifier) => {
    const query = `
        SELECT * FROM users WHERE name = ? OR email = ?
    `;
    return db.execute(query, [identifier, identifier]);
};

module.exports = {
    getAllUsers,
    getUserById,
    getUsersByRole,
    insertUser,
    updateUser,
    getUserByUsername,
    getUserByUsernameOrEmail // ✅ Tambahan untuk login fleksibel
};
