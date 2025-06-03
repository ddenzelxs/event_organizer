const knex = require('knex');

const db = knex({
  client: 'mysql2',
  connection: {
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'db_event',
    port: 3306,
  },
  pool: { min: 0, max: 7 },
});

module.exports = db;
