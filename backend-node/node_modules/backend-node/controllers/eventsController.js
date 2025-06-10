const Event = require('../models/eventsModel');

exports.getAllEvents = async (req, res) => {
  try {
    const events = await Event.getAll();
    res.json(events);
  } catch (err) {
    res.status(500).json({ message: 'Gagal mengambil event', error: err.message });
  }
};

exports.createEvent = async (req, res) => {
  const {
    name, date, time, location,
    price, max_participants, status,
    managed_by, created_by
  } = req.body;

  const poster_url = req.file ? `/uploads/posters/${req.file.filename}` : null;

  try {
    const [id] = await Event.create({
      name, date, time, location,
      price, max_participants, status,
      managed_by, created_by, poster_url
    });

    res.status(201).json({ message: 'Event berhasil ditambahkan', id });
  } catch (err) {
    res.status(500).json({ message: 'Gagal menambah event', error: err.message });
  }
};

exports.updateEvent = async (req, res) => {
  try {
    const updated = await Event.update(req.params.id, {
      ...req.body,
      updated_at: new Date()
    });

    if (!updated) return res.status(404).json({ message: 'Event tidak ditemukan' });

    res.json({ message: 'Event berhasil diperbarui' });
  } catch (err) {
    res.status(500).json({ message: 'Gagal update event', error: err.message });
  }
};

exports.toggleEventStatus = async (req, res) => {
  try {
    const event = await Event.getById(req.params.id);
    if (!event) {
      return res.status(404).json({ message: 'Event tidak ditemukan' });
    }

    await Event.toggleStatus(req.params.id, event.status);

    res.json({ message: `Event berhasil di-${event.status === 1 ? 'nonaktifkan' : 'aktifkan'}` });
  } catch (err) {
    res.status(500).json({ message: 'Gagal mengubah status event', error: err.message });
  }
};
