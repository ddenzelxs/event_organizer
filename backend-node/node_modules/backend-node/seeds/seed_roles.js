/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.seed = async function(knex) {
  await knex('role').del();

  await knex('role').insert([
    {nama_role: 'member' },
    {nama_role: 'administrator' },
    {nama_role: 'finance_team' },
    {nama_role: 'event_committee' }
  ]);
};
