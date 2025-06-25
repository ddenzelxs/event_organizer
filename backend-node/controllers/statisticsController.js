const { getAllEvents } = require('../models/eventsModel');
const { getAllUsers } = require('../models/usersModel');
const db = require('../database/database');

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

const getEventCommitteeStats = async (req, res) => {
  try {
    const userId = req.user.id;

    const [registered] = await db.execute(`
      SELECT COUNT(*) AS total FROM registrations 
      WHERE session_id IN (SELECT id FROM events WHERE created_by = ?)`,
      [userId]
    );

    const [attendanceApproved] = await db.execute(`
      SELECT COUNT(*) AS total FROM registrations 
      WHERE attendance_status = '1' AND session_id IN 
      (SELECT id FROM events WHERE created_by = ?)`,
      [userId]
    );

    const [paymentApproved] = await db.execute(`
      SELECT COUNT(*) AS total FROM registrations 
      WHERE payment_status = '1' AND session_id IN 
      (SELECT id FROM events WHERE created_by = ?)`,
      [userId]
    );

    res.json({
      message: 'Event Committee statistics fetched successfully',
      data: {
        registered: registered[0].total,
        attendanceApproved: attendanceApproved[0].total,
        paymentApproved: paymentApproved[0].total
      }
    });
  } catch (err) {
    console.error(err);
    res.status(500).json({ message: 'Server Error', error: err.message });
  }
};

module.exports = { getSummary, getEventCommitteeStats };
