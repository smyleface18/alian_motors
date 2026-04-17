CREATE TABLE owners (
    cc VARCHAR(20) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20)
);

-- =========================
-- Tabla: cars
-- =========================
CREATE TABLE cars (
    license_plate VARCHAR(10) PRIMARY KEY,
    owner_cc VARCHAR(20),
    model VARCHAR(50),
    line VARCHAR(50),
    brand VARCHAR(50),

    CONSTRAINT fk_owner
        FOREIGN KEY (owner_cc)
        REFERENCES owners(cc)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- =========================
-- Tabla: maintenances
-- =========================
CREATE TABLE maintenances (
    id INT AUTO_INCREMENT PRIMARY KEY,
    car_plate VARCHAR(10),
    date DATE,
    description TEXT,
    cost DECIMAL(10,2),

    CONSTRAINT fk_car
        FOREIGN KEY (car_plate)
        REFERENCES cars(license_plate)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);