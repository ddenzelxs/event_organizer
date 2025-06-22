require('dotenv').config(); // agar JWT_SECRET bisa diakses
const express = require('express');
const cors = require('cors');

const app = express();
const authenticateToken = require('./middleware/auth');

// Import routes
const authRoutes = require('./routes/auth');
const roleRoutes = require('./routes/role');
const userRoutes = require('./routes/users');
const eventRoutes = require('./routes/events');
const sessionRoutes = require('./routes/eventSessions');
const registrationRoutes = require('./routes/registrations');
const certificateRoutes = require('./routes/cerificates');

app.use(cors({
  origin: 'http://localhost:5173',
  credentials: true,
}));
app.use(express.json());

// Public route ac
app.use('/api/auth', authRoutes);

// Protected routes
app.use('/api/roles', authenticateToken, roleRoutes);
app.use('/api/users', authenticateToken, userRoutes);
app.use('/api/events', authenticateToken, eventRoutes);
app.use('/api/sessions', authenticateToken, sessionRoutes);
app.use('/api/registrations', authenticateToken, registrationRoutes);
app.use('/api/certificate', authenticateToken, certificateRoutes);



app.listen(3000, () => {
  console.log('Server running on http://localhost:3000');
});
