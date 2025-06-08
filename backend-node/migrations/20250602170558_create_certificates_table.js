exports.up = function (knex) {
  return knex.schema.createTable('certificates', (table) => {
    table.increments('id').primary();
    table.integer('regist_id').unsigned().nullable();
    table.string('certificate_url', 255).notNullable();
    table.timestamp('issued_at').defaultTo(knex.fn.now());
  });
};
exports.down = function (knex) {
  return knex.schema.dropTableIfExists('certificates');
};
