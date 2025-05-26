exports.up = function (knex) {
  return knex.schema.createTable('certificates', function (table) {
    table.increments('id');
    table.integer('regist_id').unsigned().references('id').inTable('registrations');
    table.string('certificate_url', 255).notNullable();
    table.timestamp('issued_at').defaultTo(knex.fn.now());
  });
};

exports.down = function (knex) {
  return knex.schema.dropTable('certificates');
};
