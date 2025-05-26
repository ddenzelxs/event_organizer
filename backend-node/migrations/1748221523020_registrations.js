exports.up = function (knex) {
  return knex.schema.createTable('registrations', function (table) {
    table.increments('id');
    table.integer('user_id').unsigned().references('id').inTable('users');
    table.integer('event_id').unsigned().references('id').inTable('events')
    table.integer('status');
    table.string('payment_proof_url', 255);
    table.timestamp('registered_at').defaultTo(knex.fn.now());
    table.timestamp('approved_at').defaultTo(knex.fn.now());
    table.string('qrcode', 255);
    table.boolean('attendance_status');
  });
};

exports.down = function (knex) {
  return knex.schema.dropTable('registrations');
};
