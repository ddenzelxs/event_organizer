exports.up = function (knex) {
  return knex.schema.createTable('role', function (table) {
    table.increments('id');
    table.string('name', 20).notNullable();
  });
};

exports.down = function (knex) {
  return knex.schema.dropTable('role');
};
