-- Setup database untuk folder sesi-8 (users, products, orders)
-- Jalankan sekali sebelum mencoba aplikasinya.

CREATE DATABASE IF NOT EXISTS ecommerce_db;
USE ecommerce_db;

-- Tabel users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT IGNORE INTO users (id, name, email, password) VALUES
(1, 'Budi Santoso', 'budi@example.com', 'hashed_password_1');

-- Tabel products
DROP TABLE IF EXISTS products;
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    price DECIMAL(12,2) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    stock INT NOT NULL DEFAULT 0,
    category VARCHAR(50) NOT NULL DEFAULT 'Umum',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO products (name, price, description, image, stock, category) VALUES
('Laptop', 8500000, 'Laptop performa tinggi untuk kerja dan gaming', 'laptop.jpg', 10, 'Elektronik'),
('Kaos Polos', 75000, 'Kaos katun combed nyaman dipakai harian', 'kaos.jpg', 40, 'Pakaian'),
('Novel Misteri', 65000, 'Novel best seller genre misteri', 'novel.jpg', 15, 'Buku'),
('Blender Mini', 250000, 'Blender praktis untuk membuat jus', 'blender.jpg', 20, 'Rumah Tangga');

-- Tabel orders
CREATE TABLE IF NOT EXISTS orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    total DECIMAL(12,2) NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_orders_user FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE ON UPDATE CASCADE,

    CONSTRAINT fk_orders_product FOREIGN KEY (product_id) REFERENCES products(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);
