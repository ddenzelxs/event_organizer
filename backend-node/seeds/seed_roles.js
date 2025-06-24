/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.seed = async function(knex) {
  await knex('role').del();

  await knex('role').insert([
    {nama_role: 'Member' },
    {nama_role: 'Administrator' },
    {nama_role: 'Finance' },
    {nama_role: 'Event Committee' }
  ]);
};
