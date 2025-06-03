const express = require('express');
const cors = require('cors');
const app = express();

const eventsRoutes = require('./routes/events');

app.use(express.json());

app.use(cors({
  origin: 'http://localhost:5173',
  credentials: true,
}));

// Testing endpoint

// Event routes
app.use('/api/events', eventsRoutes);

app.listen(3000, () => {
  console.log('Server berjalan di http://localhost:3000');
});
