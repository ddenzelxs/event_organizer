const bcrypt = require('bcrypt');

/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.seed = async function (knex) {
  await knex('users').del();

  const hashedPassword = await bcrypt.hash('admin123', 10);

  await knex('users').insert([
    {
      name: 'Administrator',
      email: 'admin@event.com',
      password: hashedPassword,
      role_id: 3
    },
    {
      name: 'Panitia 1',
      email: 'panitia1@event.com',
      password: hashedPassword,
      role_id: 2
    },
    {
      name: 'Panitia 2',
      email: 'panitia2@event.com',
      password: hashedPassword,
      role_id: 2
    }
  ]);
};
