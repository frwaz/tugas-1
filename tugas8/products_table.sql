-- =========================================================
-- Tabel products untuk folder sesi-8
-- Kolom: id, name, price, description, image, stock, category
-- =========================================================
USE ecommerce_db;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    price DECIMAL(12,2) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    stock INT NOT NULL DEFAULT 0,
    category VARCHAR(50) NOT NULL DEFAULT 'Umum',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Data contoh
INSERT INTO products (name, price, description, image, stock, category) VALUES
('Laptop', 8500000, 'Laptop performa tinggi untuk kerja dan gaming', 'laptop.jpg', 10, 'Elektronik'),
('Kaos Polos', 75000, 'Kaos katun combed nyaman dipakai harian', 'kaos.jpg', 40, 'Pakaian'),
('Novel Misteri', 65000, 'Novel best seller genre misteri', 'novel.jpg', 15, 'Buku');
