const db = require('../database/database');


const getAllEvents = async () => {
    const query = `
        SELECT events.name, events.date, events.time, events.location, events.price, events.max_participants
        events.status, events.managed_by, events.created_by
        FROM events`;
    return db.execute(query);
}

const getEventById = async (id) => {
    const query = `
        SELECT events.name, events.date, events.time, events.location, events.price, events.max_participants
        events.status, events.managed_by, events.created_by
        FROM events
        WHERE events.id = ?`;
    return db.execute(query, [id])
}

module.exports = {
    getAllEvents,
    getEventById
};
