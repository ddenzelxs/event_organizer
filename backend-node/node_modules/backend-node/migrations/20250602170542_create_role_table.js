exports.up = function (knex) {
  return knex.schema.createTable('role', (table) => {
    table.increments('id').primary();
    table.string('nama_role', 20).notNullable();
  });
};
exports.down = function (knex) {
  return knex.schema.dropTableIfExists('role');
};
