CREATE TABLE users(
    u_id INT AUTO_INCREMENT,
    email VARCHAR(50) UNIQUE,
    u_name VARCHAR(50) UNIQUE,
    password VARCHAR(256) NOT NULL,
    type VARCHAR(8) NOT NULL,
    
    PRIMARY KEY(u_id)
);

CREATE TABLE customer(
    u_id INT,
    c_name VARCHAR(50),
    c_phone VARCHAR(10) UNIQUE,
    
    PRIMARY KEY(u_id),
    FOREIGN KEY(u_id) REFERENCES users(u_id)
);

CREATE TABLE merchant(
    u_id INT,
    m_name VARCHAR(50),
    m_phone VARCHAR(10) UNIQUE,
    photo TEXT DEFAULT 'default.jpg',
    opening_hours_start TIME,
    opening_hours_end TIME,
    delivery CHAR(1),
    manager_name VARCHAR(50),
    manager_phone VARCHAR(10),
    address_city VARCHAR(30),
    address_district VARCHAR(30),
    address_detail VARCHAR(50),
    
    PRIMARY KEY(u_id),
    FOREIGN KEY(u_id) REFERENCES users(u_id)
);

CREATE TABLE orders(
    o_id INT AUTO_INCREMENT,
    c_id INT,
    m_id INT,
    order_time DATETIME NOT NULL,
    is_accepted CHAR(1),
    accepted_time DATETIME,
    
    PRIMARY KEY(o_id, c_id, m_id),
    FOREIGN KEY(c_id) REFERENCES customer(u_id),
    FOREIGN KEY(m_id) REFERENCES merchant(u_id)
);

CREATE TABLE order_beverage(
    o_id INT,
    b_id INT,
    sugar INT NOT NULL,
    ice INT NOT NULL,
    quantity INT NOT NULL,
    
    PRIMARY KEY(b_id, o_id),
    FOREIGN KEY(o_id) REFERENCES orders(o_id),
    FOREIGN KEY(b_id) REFERENCES menu_beverage(b_id)
);

CREATE TABLE menu_beverage(
    u_id INT,
    b_id INT UNIQUE AUTO_INCREMENT,
    b_name VARCHAR(50) NOT NULL,
    price INT DEFAULT 0,

    PRIMARY KEY(u_id, b_id),
    FOREIGN KEY(u_id) REFERENCES merchant(u_id)
);

CREATE TABLE sugar_type(
    b_id INT,
    sugar_value INT,

    PRIMARY KEY(b_id, sugar_value),
    FOREIGN KEY(b_id) REFERENCES menu_beverage(b_id)
        ON DELETE CASCADE
);

CREATE TABLE ice_type(
    b_id INT,
    ice_value INT,

    PRIMARY KEY(b_id, ice_value),
    FOREIGN KEY(b_id) REFERENCES menu_beverage(b_id)
        ON DELETE CASCADE
);

CREATE TABLE comments(
    c_id INT NOT NULL,
    m_id INT NOT NULL,
    stars INT,
    content TEXT,
    time DATETIME,
    
    PRIMARY KEY(c_id, m_id),
    FOREIGN KEY(m_id) REFERENCES merchant(u_id),
    FOREIGN KEY(c_id) REFERENCES customer(u_id)
);
