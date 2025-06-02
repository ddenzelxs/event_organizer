const bcrypt = require('bcrypt');

/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.seed = async function(knex) {
  await knex('users').del();

  const hashedPassword = await bcrypt.hash('admin123', 10);

  await knex('users').insert([
    {
      name: 'Administrator',
      email: 'admin@event.com',
      password: hashedPassword,
      role_id: 3
    }
  ]);
};
