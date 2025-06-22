const bcrypt = require('bcrypt');

/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.seed = async function (knex) {
  await knex('users').del();

  const hashedPassword = await bcrypt.hash('user123', 10);

  await knex('users').insert([
    {
      name: 'Administrator',
      email: 'admin@event.com',
      password: hashedPassword,
      role_id: 4
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
    },
    {
      name: 'User 1',
      email: 'user1@event.com',
      password: hashedPassword,
      role_id: 1
    },
    {
      name: 'User 2',
      email: 'user2@event.com',
      password: hashedPassword,
      role_id: 1
    },
    {
      name: 'User 3',
      email: 'user3@event.com',
      password: hashedPassword,
      role_id: 1
    },
    {
      name: 'User 4',
      email: 'user4@event.com',
      password: hashedPassword,
      role_id: 1
    }
  ]);
};
