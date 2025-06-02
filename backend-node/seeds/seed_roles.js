/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.seed = async function(knex) {
  await knex('role').del();

  await knex('role').insert([
    { id: 1, name: 'member' },
    { id: 2, name: 'administrator' },
    { id: 3, name: 'finance_team' },
    { id: 4, name: 'event_committee' }
  ]);
};
