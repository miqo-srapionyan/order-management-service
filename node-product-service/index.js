const express = require('express');
const app = express();
const productRoutes = require('./routes/productRoutes');

app.use(express.json());
app.use('/', productRoutes);

const PORT = 3000;
app.listen(PORT, () => console.log(`Product service running on port ${PORT}`));
