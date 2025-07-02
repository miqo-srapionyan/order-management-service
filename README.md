# Order Management System

This project is a **simple Order Management System** composed of two separate services:
- A **PHP Order Service** (Slim Framework)
- A **Node.js Product Service** (Express)

Both services work together to demonstrate basic order creation, product retrieval, and simple service communication.

---

## ⚙️ Requirements
- PHP 8.2 or higher (must be pre-installed)
- Node.js (must be pre-installed)
- Composer (for PHP dependencies)
- NPM or Yarn (for Node.js dependencies)

---

## 📦 Project Structure
```text
.
├── node-product-service/  # Product Service (Node.js)
├── php-order-service/     # Order Service (PHP)
├── README.md              # Root Readme
└── .gitignore             
```

Each service has its own README.md with setup instructions:
- PHP Order Service Setup
- Node.js Product Service Setup

## 🚀 Getting Started

Clone the repository

```bash
git clone git@github.com:miqo-srapionyan/order-management-service.git
cd order-management-service
```

Follow the individual service setup instructions provided in their respective folders.

## 🛠️ Example cURL Requests

#### 1. Get Products (from Node.js Product Service)
```bash
curl -X GET http://localhost:8000/products 
```
🔸 Copy a productId from the response for the next step.

#### 2. Create Order (in PHP Order Service)
```bash
curl -X POST http://localhost:8000/orders \
-H "Content-Type: application/json" \
-d '{
  "productId": "",
  "quantity": 2
}'
 
```
🔸 Replace the productId with one copied from the /products response.

#### 3. List Orders (from PHP Order Service)

```bash
curl -X GET http://localhost:8000/orders
```
⚠️ Important: The PHP Order Service does not use persistent storage.
Orders are stored in memory and are cleared after each request (non-persistent).
This is intentional for demo purposes.

## 📚 Additional Notes
This is a basic example to demonstrate service-to-service communication using HTTP requests.

Both services can be started independently.

The PHP service communicates with the Node.js service to fetch product data.