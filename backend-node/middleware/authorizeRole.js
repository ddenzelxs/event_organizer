module.exports = function authorizeRole(...allowedRoles) {
  return (req, res, next) => {
    const user = req.user;

    if (!user || !allowedRoles.includes(user.role_id)) {
      return res.status(403).json({ message: 'Akses ditolak: role tidak diizinkan' });
    }

    next();
  };
};
