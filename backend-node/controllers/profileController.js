const bcrypt = require('bcrypt');
const knex = require('../config/db_event'); // asumsi file koneksi knex
const { validationResult } = require('express-validator');

// GET - render profile edit page (jika pakai templating engine)
exports.getProfile = async (req, res) => {
  const userId = req.session.user?.id;
  if (!userId) return res.redirect('/login');

  try {
    const user = await knex('users').where({ id: userId }).first();
    res.render('profile-edit', { user });
  } catch (err) {
    console.error('Error fetching profile:', err);
    res.status(500).send('Server Error');
  }
};

// PUT - update profile
exports.updateProfile = async (req, res) => {
  const userId = req.session.user?.id;
  if (!userId) return res.redirect('/login');

  const errors = validationResult(req);
  if (!errors.isEmpty()) {
    return res.status(400).render('profile-edit', {
      user: req.body,
      errors: errors.array()
    });
  }

  const { name, username, password } = req.body;

  try {
    const updateData = {
      name,
      username,
    };

    if (password) {
      const hashed = await bcrypt.hash(password, 10);
      updateData.password = hashed;
    }

    await knex('users').where({ id: userId }).update(updateData);

    // Update session (opsional)
    req.session.user.name = name;
    req.session.user.username = username;

    res.redirect('/profile');
  } catch (err) {
    console.error('Error updating profile:', err);
    res.status(500).send('Server Error');
  }
};
