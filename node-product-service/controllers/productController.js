const productService = require('../services/productService');

const getProducts = (req, res) => {
    const products = productService.getAllProducts();
    res.json(products);
};

const getProduct = (req, res) => {
    const product = productService.getProductById(req.params.id);
    if (!product) return res.status(404).json({ message: 'Product not found' });
    res.json(product);
};

module.exports = { getProducts, getProduct };
