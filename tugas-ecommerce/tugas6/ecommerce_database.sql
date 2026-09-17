-- =========================================================
-- DATABASE E-COMMERCE
-- Berisi: tabel products, users, orders
-- Serta contoh query CRUD untuk tabel products
-- =========================================================

CREATE DATABASE IF NOT EXISTS ecommerce_db;
USE ecommerce_db;

-- =========================================================
-- 1. TABEL PRODUCTS
-- Menyimpan informasi produk: id, nama, harga, deskripsi, stok
-- =========================================================
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(150) NOT NULL,
    price DECIMAL(12,2) NOT NULL,
    description TEXT,
    stock INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =========================================================
-- 2. TABEL USERS
-- Menyimpan data pengguna: id, nama, email, password
-- =========================================================
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,  -- simpan dalam bentuk hash, jangan plain text
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================================
-- 3. TABEL ORDERS
-- Menyimpan data pesanan: order_id, user_id, product_id, quantity, total
-- =========================================================
CREATE TABLE IF NOT EXISTS orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    total DECIMAL(12,2) NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_orders_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_orders_product
        FOREIGN KEY (product_id) REFERENCES products(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- =========================================================
-- (Opsional) Data contoh untuk pengujian
-- =========================================================
INSERT INTO products (product_name, price, description, stock) VALUES
('Smartphone X10', 3500000, 'Smartphone layar penuh dengan kamera 48MP', 25),
('Laptop Ultra', 8500000, 'Laptop ringan untuk kerja dan kuliah', 10),
('Headphone Wireless', 450000, 'Headphone bluetooth dengan suara jernih', 50);

INSERT INTO users (name, email, password) VALUES
('Budi Santoso', 'budi@example.com', 'hashed_password_1'),
('Siti Aminah', 'siti@example.com', 'hashed_password_2');

INSERT INTO orders (user_id, product_id, quantity, total) VALUES
(1, 1, 1, 3500000),
(2, 3, 2, 900000);


-- =========================================================
-- QUERY CRUD UNTUK TABEL PRODUCTS
-- =========================================================

-- ---------------------------------------------------------
-- CREATE: Menambah produk baru
-- ---------------------------------------------------------
INSERT INTO products (product_name, price, description, stock)
VALUES ('Blender Mini', 250000, 'Blender praktis untuk membuat jus', 30);

-- ---------------------------------------------------------
-- READ: Membaca data produk
-- ---------------------------------------------------------

-- Menampilkan semua produk
SELECT * FROM products;

-- Menampilkan satu produk berdasarkan id
SELECT * FROM products WHERE id = 1;

-- Menampilkan produk dengan stok menipis (contoh: kurang dari 10)
SELECT * FROM products WHERE stock < 10;

-- Mencari produk berdasarkan nama (LIKE untuk pencarian sebagian kata)
SELECT * FROM products WHERE product_name LIKE '%laptop%';

-- ---------------------------------------------------------
-- UPDATE: Mengubah data produk
-- ---------------------------------------------------------

-- Mengubah harga dan stok produk berdasarkan id
UPDATE products
SET price = 3300000, stock = 20
WHERE id = 1;

-- Mengurangi stok produk (misalnya setelah ada pesanan)
UPDATE products
SET stock = stock - 1
WHERE id = 1 AND stock > 0;

-- ---------------------------------------------------------
-- DELETE: Menghapus data produk
-- ---------------------------------------------------------

-- Menghapus produk berdasarkan id
DELETE FROM products WHERE id = 5;

-- Menghapus produk yang stoknya habis (opsional, contoh kondisi lain)
-- DELETE FROM products WHERE stock = 0;
