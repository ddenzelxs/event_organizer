exports.up = function (knex) {
  return knex.schema.createTable('event_sessions', (table) => {
    table.increments('id').primary();
    table.integer('event_id').unsigned().notNullable().references('id').inTable('events').onDelete('CASCADE');
    table.string('name', 100).notNullable();
    table.date('session_date').notNullable();
    table.time('session_time').notNullable();
    table.string('speaker', 255).notNullable();
    table.string('location', 200);
    table.integer('max_participants');
    table.timestamp('created_at').defaultTo(knex.fn.now());
    table.timestamp('updated_at').defaultTo(knex.fn.now());
  });
};

exports.down = function (knex) {
  return knex.schema.dropTableIfExists('event_sessions');
};
