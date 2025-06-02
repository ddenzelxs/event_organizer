exports.up = function (knex) {
  return knex.schema.createTable('certificates', (table) => {
    table.increments('id').primary();
    table.integer('user_id').unsigned().notNullable();
    table.integer('event_id').unsigned().notNullable();
    table.integer('regist_id').unsigned().notNullable().references('id').inTable('registrations').onDelete('CASCADE');
    table.string('certificate_url', 255).notNullable();
    table.timestamp('issued_at').defaultTo(knex.fn.now());
  });
};

exports.down = function (knex) {
  return knex.schema.dropTableIfExists('certificates');
};
