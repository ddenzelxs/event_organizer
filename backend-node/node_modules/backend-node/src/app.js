const express = require('express');
const cors = require('cors');
require('dotenv').config();

const app = express();

app.use(cors());
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// routes
const authRoutes = require('./routes/auth');
app.use('/api/auth', authRoutes);

// (tambahkan route lain di sini)

module.exports = app;
