const express = require('express');
const router = express.Router();
const { getProducts, getProduct } = require('../controllers/productController');

router.get('/products/:id', getProduct);
router.get('/products', getProducts);

module.exports = router;
