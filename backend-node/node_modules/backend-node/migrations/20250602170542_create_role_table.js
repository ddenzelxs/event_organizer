exports.up = function (knex) {
  return knex.schema.createTable('role', (table) => {
    table.increments('id').primary();
    table.string('name', 20).notNullable();
  });
};

exports.down = function (knex) {
  return knex.schema.dropTableIfExists('role');
};
