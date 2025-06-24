const jwt = require('jsonwebtoken');
const bcrypt = require('bcryptjs');
const { getUserByUsername } = require('../models/usersModel'); // Gunakan yang lebih fleksibel

const login = async (req, res) => {
  const { username, password } = req.body;

  if (!username || !password) {
    return res.status(400).json({ message: 'Username dan password wajib diisi' });
  }

  try {
    const [users] = await getUserByUsername(username); // Bisa pakai username atau email
    const user = users[0];

    if (!user) {
      return res.status(404).json({ message: 'User tidak ditemukan' });
    }

    const match = await bcrypt.compare(password, user.password);
    if (!match) {
      return res.status(401).json({ message: 'Password salah' });
    }

    // Token payload hanya data penting
    const tokenPayload = {
      id: user.id,
      name: user.name,
      email: user.email,
      role_id: user.role_id
    };

    const token = jwt.sign(tokenPayload, process.env.JWT_SECRET, { expiresIn: '1h' });

    res.json({
      message: 'Login berhasil',
      token,
      user: tokenPayload
    });

  } catch (err) {
    console.error('Login error:', err); // Logging untuk debug server
    res.status(500).json({ message: 'Server error', error: err.message });
  }
};

module.exports = {
  login
};
