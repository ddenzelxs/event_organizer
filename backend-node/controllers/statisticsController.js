const { getAllEvents } = require('../models/eventsModel');
const { getAllUsers } = require('../models/usersModel');

const getSummary = async (req, res) => {
  try {
    const [events] = await getAllEvents();
    const [users] = await getAllUsers();

    const eventBerjalan = events.filter(event => event.status === 1).length;
    const eventSelesai = events.filter(event => event.status === 0).length;
    const totalPengguna = users.length;

    res.json({
      message: 'Statistik berhasil diambil',
      data: {
        eventBerjalan,
        eventSelesai,
        totalPengguna
      }
    });
  } catch (error) {
    res.status(500).json({
      message: 'Gagal mengambil statistik',
      error: error.message
    });
  }
};

module.exports = { getSummary };
