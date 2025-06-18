const {
  getAllCertificates, getCertificateById, insertCertificate, deleteCertificate} = require('../models/certificationModel');

const getAll = async (req, res) => {
  try {
    const [certificates] = await getAllCertificates();
    res.json({ message: 'GET all certificates success', data: certificates });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error });
  }
};

const getById = async (req, res) => {
  try {
    const [certificate] = await getCertificateById(req.params.id);
    res.json({ message: 'GET certificate success', data: certificate });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error });
  }
};

const create = async (req, res) => {
  const { registration_id, file_path } = req.body;
  try {
    await insertCertificate(registration_id, file_path);
    res.status(201).json({ message: 'CREATE certificate success' });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error });
  }
};

const deleteById = async (req, res) => {
  try {
    await deleteCertificate(req.params.id);
    res.json({ message: 'DELETE certificate success' });
  } catch (error) {
    res.status(500).json({ message: 'Server Error', serverMessage: error });
  }
};

module.exports = {
  getAll,
  getById,
  create,
  deleteById
};
