const express = require('express');
const cors = require('cors');
const app = express();

// Import route files
const roleRoutes = require('./routes/role');
const userRoutes = require('./routes/users');
const eventRoutes = require('./routes/events');
const sessionRoutes = require('./routes/eventSessions');
const registrationRoutes = require('./routes/registrations');
const certificateRoutes = require('./routes/cerification');

app.use(cors({
  origin: 'http://localhost:5173',
  credentials: true,
}));
app.use(express.json());

// Prefix each group
app.use('/api/roles', roleRoutes);
app.use('/api/users', userRoutes);
app.use('/api/events', eventRoutes);
app.use('/api/sessions', sessionRoutes);
app.use('/api/registrations', registrationRoutes);
app.use('/api/certification', certificateRoutes);

app.listen(3000, () => {
  console.log('Server running on http://localhost:3000');
});