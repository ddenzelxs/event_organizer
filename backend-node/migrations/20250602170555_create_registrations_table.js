exports.up = function (knex) {
  return knex.schema.createTable('registrations', (table) => {
    table.increments('id').primary();
    table.integer('user_id').unsigned().nullable();
    table.integer('session_id').unsigned().nullable();
    table.string('payment_proof', 255);
    table.timestamp('registered_at').defaultTo(knex.fn.now());
    table.timestamp('approved_at').nullable();
    table.string('qrcode', 255);
    table.boolean('attendance_status');
    table.boolean('payment_status');
  });
};
exports.down = function (knex) {
  return knex.schema.dropTableIfExists('registrations');
};
