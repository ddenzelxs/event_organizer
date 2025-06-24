require('dotenv').config(); // agar JWT_SECRET bisa diakses
const express = require('express');
const cors = require('cors');

const app = express();

// Middleware
const authenticateToken = require('./middleware/auth');
const authorizeRole = require('./middleware/authorizeRole'); // tambahkan ini

// Import routes
const authRoutes = require('./routes/auth');
const roleRoutes = require('./routes/role');
const userRoutes = require('./routes/users');
const eventRoutes = require('./routes/events');
const sessionRoutes = require('./routes/eventSessions');
const registrationRoutes = require('./routes/registrations');
const certificateRoutes = require('./routes/cerificates');
const statisticsRoutes = require('./routes/statistics');

app.use(cors({
  origin: 'http://localhost:5173',
  credentials: true,
}));
app.use(express.json());

// Public route
app.use('/api/auth', authRoutes);

// Protected routes dengan role-based authorization
app.use('/api/roles', roleRoutes);
app.use('/api/users', userRoutes);
app.use('/api/events', eventRoutes);
app.use('/api/sessions', sessionRoutes);
app.use('/api/registrations', registrationRoutes);
app.use('/api/certificate', certificateRoutes);
app.use('/api/statistics', statisticsRoutes);

app.listen(3000, () => {
  console.log('Server running on http://localhost:3000');
});
