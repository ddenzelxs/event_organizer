const { findAllUsers, findUsersByRole, insertUser, updateUser } = require('../models/usersModel')

const getAllUsers = async (req, res) => {
    try {
        const [data] = await findAllUsers();
        res.json(data);
    } catch (error) {
        res.status(500).json({
            message: "Server Error",
            serverMessage: error,
        });
    }
};

const getUsersByRole = async (req, res) => {
    const role = req.params.role_id;
    console.log('role:', role)
    try {
        const [data] = await findUsersByRole(role);
        if (data.length < 1) {
            return res.status(404).json({
                message: "Role tidak ditemukan",
            });
        }
        console.log('dapat')
        res.json({
            message: "GET User by role success",
            data: data,
        });
    } catch (error) {
        
        res.status(500).json({
            message: "Server Error",
            serverMessage: error,
        });
    }
};

module.exports = {
    getAllUsers,
    getUsersByRole
}