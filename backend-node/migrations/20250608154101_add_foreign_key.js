exports.up = function (knex) {
  return Promise.all([
    knex.schema.alterTable('users', (table) => {
      table.foreign('role_id').references('id').inTable('role').onDelete('SET NULL');
    }),

    knex.schema.alterTable('events', (table) => {
      table.foreign('managed_by').references('id').inTable('users').onDelete('CASCADE');
      table.foreign('created_by').references('id').inTable('users').onDelete('CASCADE');
    }),

    knex.schema.alterTable('event_sessions', (table) => {
      table.foreign('event_id').references('id').inTable('events').onDelete('CASCADE');
    }),

    knex.schema.alterTable('registrations', (table) => {
      table.foreign('user_id').references('id').inTable('users').onDelete('CASCADE');
      table.foreign('session_id').references('id').inTable('event_sessions').onDelete('SET NULL');
    }),

    knex.schema.alterTable('certificates', (table) => {
      table.foreign('regist_id').references('id').inTable('registrations').onDelete('CASCADE');
    }),
  ]);
};

exports.down = function (knex) {
  return Promise.all([
    knex.schema.alterTable('users', (table) => {
      table.dropForeign('role_id');
    }),

    knex.schema.alterTable('events', (table) => {
      table.dropForeign('managed_by');
      table.dropForeign('created_by');
    }),

    knex.schema.alterTable('event_sessions', (table) => {
      table.dropForeign('event_id');
    }),

    knex.schema.alterTable('registrations', (table) => {
      table.dropForeign('user_id');
      table.dropForeign('session_id');
    }),

    knex.schema.alterTable('certificates', (table) => {
      table.dropForeign('regist_id');
    }),
  ]);
};
