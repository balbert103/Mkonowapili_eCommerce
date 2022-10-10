CREATE TABLE tbl_roles (
    role_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    role_name VARCHAR(15) NOT NULL,
    is_deleted BOOLEAN DEFAULT FALSE
);


CREATE TABLE tbl_users (
    user_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(25) NOT NULL,
    last_name VARCHAR(25),
    email VARCHAR(60) UNIQUE NOT NULL,
    password VARCHAR(60),
    gender ENUM('male', 'female'),
    role INT(11),
    is_deleted BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (role) REFERENCES tbl_roles(role_id) ON DELETE RESTRICT
);


CREATE TABLE tbl_categories (
    category_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(25) NOT NULL,
    is_deleted BOOLEAN DEFAULT FALSE
);


CREATE TABLE tbl_subcategories (
    subcategory_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    subcategory_name VARCHAR(25) NOT NULL,
    category INT(11),
    is_deleted BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (category) REFERENCES tbl_categories (category_id) ON DELETE CASCADE
);


CREATE TABLE tbl_product (
    product_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(25) NOT NULL,
    product_description TEXT,
    product_image VARCHAR(40),
    product_price DOUBLE,
    available_quantity INT(11) CHECK (available_quantity >= 0),
    subcategory_id INT(11),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME,
    added_by INT(11),
    is_deleted BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (subcategory_id) REFERENCES tbl_subcategories (subcategory_id) ON DELETE SET NULL,
    FOREIGN KEY (added_by) REFERENCES tbl_users (user_id) ON DELETE SET NULL
);


CREATE TABLE tbl_productimages (
    productimages_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    product_image VARCHAR(40),
    product_id INT(11),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME,
    added_by INT(11),
    is_deleted BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (product_id) REFERENCES tbl_product(product_id) ON DELETE CASCADE,
    FOREIGN KEY (added_by) REFERENCES tbl_users(user_id) ON DELETE SET NULL
);


CREATE TABLE tbl_paymenttypes (
    paymenttype_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    paymenttype_name VARCHAR(20),
    description VARCHAR(40),
    is_deleted BOOLEAN DEFAULT FALSE
);


CREATE TABLE tbl_orderdetails (
    orderdetails_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    customer_id INT(11),
    product_id INT(11),
    product_price DOUBLE,
    order_quantity INT(11) DEFAULT 1,
    orderdetails_total DOUBLE GENERATED ALWAYS AS (product_price * order_quantity),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME,
    is_deleted BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (customer_id) REFERENCES tbl_users (user_id) ON DELETE NO ACTION,
    FOREIGN KEY (product_id) REFERENCES tbl_product (product_id) ON DELETE CASCADE
);


CREATE TABLE tbl_order (
    order_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    customer_id INT(11),
    order_amount DOUBLE DEFAULT 0,
    order_status ENUM('pending', 'pending payment', 'paid'),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    payment_type INT(11),
    updated_at DATETIME,
    is_deleted BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (customer_id) REFERENCES tbl_users (user_id) ON DELETE NO ACTION,
    FOREIGN KEY (payment_type) REFERENCES tbl_paymenttypes (paymenttype_id) ON DELETE SET NULL
);


CREATE TABLE tbl_wallet (
    wallet_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    customer_id INT(11),
    amount_available DOUBLE DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME,
    is_deleted BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (customer_id) REFERENCES tbl_users (user_id) ON DELETE CASCADE
);


CREATE TABLE tbl_userlogins (
    userlogin_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    user_id INT(11),
    user_ip VARCHAR(25),
    login_time DATETIME,
    logout_time DATETIME,
    is_deleted BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES tbl_users (user_id) ON DELETE CASCADE
);


CREATE TABLE tbl_apiusers (
    apiuser_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(40),
    `key` TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_on DATETIME,
    added_by INT(11),
    is_deleted BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (added_by) REFERENCES tbl_users (user_id) ON DELETE SET NULL
);


CREATE TABLE tbl_apiproducts (
    apiproduct_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    productname ENUM('userdetails', 'products', 'transactions'),
    added_by INT(11),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_on DATETIME,
    is_deleted BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (added_by) REFERENCES tbl_users (user_id) ON DELETE SET NULL
);


CREATE TABLE tbl_apiproductpaths (
    apiproductpath_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    path VARCHAR(60) NOT NULL,
    added_by INT(11),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME,
    is_deleted BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (added_by) REFERENCES tbl_users (user_id) ON DELETE SET NULL
);


CREATE TABLE tbl_apitokens (
    apitoken_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    api_userid INT(11),
    api_productid INT(11),
    api_token TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    expires_on DATETIME,
    is_deleted BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (api_userid) REFERENCES tbl_apiusers (apiuser_id) ON DELETE CASCADE,
    FOREIGN KEY (api_productid) REFERENCES tbl_apiproducts (apiproduct_id) ON DELETE CASCADE
);