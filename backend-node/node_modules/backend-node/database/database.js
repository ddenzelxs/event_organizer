const mysql = require('mysql2');

const dbPool = mysql.createPool({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'db_event',
});

module.exports = dbPool.promise();
