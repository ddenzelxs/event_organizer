exports.up = function (knex) {
  return knex.schema.createTable('events', (table) => {
    table.increments('id').primary();
    table.string('name', 150).notNullable();
    table.date('date').notNullable();
    table.string('location', 200);
    table.string('poster_url', 255);
    table.integer('status').notNullable();
    table.integer('managed_by').unsigned().nullable();
    table.integer('created_by').unsigned().nullable();
    table.timestamp('created_at').defaultTo(knex.fn.now());
    table.timestamp('updated_at').defaultTo(knex.fn.now());
  });
};
exports.down = function (knex) {
  return knex.schema.dropTableIfExists('events');
};
