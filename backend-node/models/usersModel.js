const db = require('../database/database');
const bcrypt = require('bcryptjs');

const findAllUsers = async (role) => {
    const query = `
    SELECT users.*
    FROM users
    `;
    return db.execute(query);
}

const findUsersByRole = async (role_id) => {
    const query = `
    SELECT users.name, users.email, role.nama_role
    FROM users
    JOIN role ON users.role_id = role.id
    WHERE users.role_id = ?
    `;
    return db.execute(query, [role_id]);
}

const insertUser = async (data) => {
    const hashedPassword = await bcrypt.hash(data.password, 8);
    const query = `
    INSERT INTO user (name, email, password, role_id, created_at, updated_at)
    VALUES (?, ?, ? ,?, now(), now());
    `
    return db.execute(query, [data.name, data.email, hashedPassword, data.role_id]);
}

const updateUser = async (id, data) => {
    let query = `
        UPDATE user 
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

module.exports = {
    findAllUsers,
    findUsersByRole,
    insertUser,
    updateUser
};