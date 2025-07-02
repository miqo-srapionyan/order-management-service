const products = require('../data/products');

const getAllProducts = () => products;

const getProductById = (id) => products.find(p => p.id === id);

module.exports = { getAllProducts, getProductById };
