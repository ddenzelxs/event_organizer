exports.up = function (knex) {
  return knex.schema.createTable('events', function (table) {
    table.increments('id');
    table.string('name', 150).notNullable();
    table.date('date').notNullable();
    table.time('time').notNullable();
    table.string('location', 200);
    table.string('speaker', 100);
    table.string('poster_url', 255);
    table.decimal('price', 10, 2).defaultTo(0.00);
    table.integer('max_participants');
    table.timestamp('created_at').defaultTo(knex.fn.now());
    table.timestamp('updated_at').defaultTo(knex.fn.now());
    table.integer('status').notNullable();
  });
};

exports.down = function (knex) {
  return knex.schema.dropTable('events');
};
