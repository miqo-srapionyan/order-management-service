const { v4: uuidv4 } = require('uuid');

const products = [
    { id: uuidv4(), name: 'Laptop', price: 1000, stock: 10 },
    { id: uuidv4(), name: 'Phone', price: 500, stock: 15 },
    { id: uuidv4(), name: 'Tablet', price: 700, stock: 1 }
];

module.exports = products;
