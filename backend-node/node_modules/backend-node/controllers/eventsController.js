const db = require('../db/knex');

// GET semua events
exports.getAllEvents = async (req, res) => {
  try {
    const events = await db('events');
    res.json(events);
  } catch (err) {
    res.status(500).json({ message: 'Gagal mengambil event', error: err.message });
    console.log('error');

  }
};

// GET 1 event
exports.getEventById = async (req, res) => {
  try {
    const event = await db('events').where({ id: req.params.id }).first();
    if (!event) return res.status(404).json({ message: 'Event tidak ditemukan' });
    res.json(event);
  } catch (err) {
    res.status(500).json({ message: 'Gagal mengambil event', error: err.message });
  }
};

// POST tambah event
exports.createEvent = async (req, res) => {
  const { name, date, time, location, poster_url, price, max_participants, status } = req.body;
  try {
    const [id] = await db('events').insert({
      name, date, time, location, poster_url, price, max_participants, status
    });
    res.status(201).json({ message: 'Event berhasil ditambahkan', id });
  } catch (err) {
    res.status(500).json({ message: 'Gagal menambah event', error: err.message });
  }
};

// PUT update event
exports.updateEvent = async (req, res) => {
  const { name, date, time, location, poster_url, price, max_participants, status } = req.body;
  try {
    const updated = await db('events').where({ id: req.params.id }).update({
      name, date, time, location, poster_url, price, max_participants, status,
      updated_at: db.fn.now()
    });
    if (!updated) return res.status(404).json({ message: 'Event tidak ditemukan' });
    res.json({ message: 'Event berhasil diperbarui' });
  } catch (err) {
    res.status(500).json({ message: 'Gagal update event', error: err.message });
  }
};

// DELETE (soft delete) event
exports.toggleEventStatus = async (req, res) => {
  try {
    // Ambil data event berdasarkan ID
    const event = await db('events').where({ id: req.params.id }).first();
    if (!event) {
      return res.status(404).json({ message: 'Event tidak ditemukan' });
    }
    console.log('masuk bang')
    // Toggle status: jika 1 menjadi 0, jika 0 menjadi 1
    const newStatus = event.status === 1 ? 0 : 1;

    // Update status
    await db('events').where({ id: req.params.id }).update({
      status: newStatus,
      updated_at: db.fn.now()
    });

    res.json({
      message: `Event berhasil di-${newStatus === 1 ? 'aktifkan' : 'nonaktifkan'}`,
      newStatus
    });
  } catch (err) {
    res.status(500).json({
      message: 'Gagal mengubah status event',
      error: err.message
    });
  }
};
