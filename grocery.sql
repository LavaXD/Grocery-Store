CREATE DATABASE grocery;
use grocery;

DROP TABLE IF EXISTS OrderDetails CASCADE;
DROP TABLE IF EXISTS Orders CASCADE;
DROP TABLE IF EXISTS Cart CASCADE;

DROP TABLE IF EXISTS Products CASCADE;
DROP TABLE IF EXISTS SubCategory CASCADE;
DROP TABLE IF EXISTS Category CASCADE;

CREATE TABLE Category (
    category_id INT PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(255) NOT NULL
);

CREATE TABLE SubCategory (
    sub_category_id INT PRIMARY KEY AUTO_INCREMENT,
    sub_category_name VARCHAR(255) NOT NULL,
    category_id INT NOT NULL,

    FOREIGN KEY (category_id) REFERENCES Category(category_id)
);

CREATE TABLE Products (
    product_id INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(255) NOT NULL,
    sub_category_id INT,
    category_id INT,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    stock_quantity INT,

    FOREIGN KEY (sub_category_id) REFERENCES SubCategory(sub_category_id),
    FOREIGN KEY (category_id) REFERENCES Category(category_id)
);

CREATE TABLE Cart (
    cart_id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT,
    quantity INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (product_id) REFERENCES Products(product_id)
);

CREATE TABLE Orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    order_date DATE,
    total_amount DECIMAL(10, 2),
    status VARCHAR(50)
);

CREATE TABLE OrderDetails (
    order_detail_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    product_id INT,
    quantity INT,
    subtotal DECIMAL(10, 2),
    FOREIGN KEY (order_id) REFERENCES Orders(order_id),
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
);


INSERT INTO Category (category_name) VALUES ('Households');
INSERT INTO Category (category_name) VALUES ('Veges&Fruits');
INSERT INTO Category (category_name) VALUES ('Drinks');
INSERT INTO Category (category_name) VALUES ('Dairy&Fridge');
INSERT INTO Category (category_name) VALUES ('Baby');
INSERT INTO Category (category_name) VALUES ('Meat&Seafood');
INSERT INTO Category (category_name) VALUES ('Pet Food');

INSERT INTO SubCategory (sub_category_name,category_id) VALUES ('Kitchen',1);
INSERT INTO SubCategory (sub_category_name,category_id) VALUES ('Cleaning',1);
INSERT INTO SubCategory (sub_category_name,category_id) VALUES ('Laundry',1);
INSERT INTO SubCategory (sub_category_name,category_id) VALUES ('Fresh Vegetable',2);
INSERT INTO SubCategory (sub_category_name,category_id) VALUES ('Fresh Fruits',2);
INSERT INTO SubCategory (sub_category_name,category_id) VALUES ('Soft Drinks',3);
INSERT INTO SubCategory (sub_category_name,category_id) VALUES ('Energy Drinks',3);
INSERT INTO SubCategory (sub_category_name,category_id) VALUES ('Milk',4);
INSERT INTO SubCategory (sub_category_name,category_id) VALUES ('Cream',4);
INSERT INTO SubCategory (sub_category_name,category_id) VALUES ('Health',5);
INSERT INTO SubCategory (sub_category_name,category_id) VALUES ('Beauty',5);
INSERT INTO SubCategory (sub_category_name,category_id) VALUES ('Beef',6);
INSERT INTO SubCategory (sub_category_name,category_id) VALUES ('Lamb',6);
INSERT INTO SubCategory (sub_category_name,category_id) VALUES ('Seafood',6);
INSERT INTO SubCategory (sub_category_name,category_id) VALUES ('Cat & Kitten',7);
INSERT INTO SubCategory (sub_category_name,category_id) VALUES ('Dog & Puppy',7);
INSERT INTO SubCategory (sub_category_name,category_id) VALUES ('Rabbit',7);

INSERT INTO Products (product_name, sub_category_id, category_id, price, description, stock_quantity) VALUES ('Dish Soap', 2, 1, 5.99, 'Gentle on hands, tough on grease', 100);
INSERT INTO Products (product_name, sub_category_id, category_id, price, description, stock_quantity) VALUES ('Laundry Detergent', 3, 1, 12.99, 'Powerful stain remover', 150);
INSERT INTO Products (product_name, sub_category_id, category_id, price, description, stock_quantity) VALUES ('Cleaning Wipes', 2, 1,3.49, 'Multi-surface cleaning', 200);
INSERT INTO Products (product_name, sub_category_id, category_id, price, description, stock_quantity) VALUES ('Pan', 1, 1,5.5, 'Nice little pan', 0);
INSERT INTO Products (product_name, sub_category_id, category_id, price, description, stock_quantity) VALUES ('Scissors', 1, 1,4, 'Beautiful Scissors', 2);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Coles Broccoli', 4, 2, 1.53, ' approx 340g', 5);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Carrots Prepacked 1Kg | 1 each ', 4, 2,2.4, ' $2.40 per 1kg', 26);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Green Zucchini | approx 200g', 4,2, 0.98, ' $4.90 per 1kg', 33);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Field Tomatoes Loose | approx 110g', 4,2, 0.95, ' $7.90 per 1kg', 23);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Continental Cucumbers Loose | 1 each', 4,2, 2.2, ' $2.20 per 1ea', 263);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Iceberg Lettuce | 1 each', 4,2, 3.7, ' $3.70 per 1ea', 29);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Bananas | approx 170g', 5,2, 0.99, ' $4.50 per 1ea', 55);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Yellow Peaches | approx 120g', 5,2, 0.71, '$5.90 per 1kg',66);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Medium Navel Oranges | approx 160g', 5,2, 1.58, '$9.90 per 1kg', 77);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Coca-Cola Classic Soft Drink Bottle | 1.25L', 6,3, 2.3, '$1.84 per 1L | Was $3.85', 23);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Bundaberg Ginger Beer 10X375mL | 10 pack', 6, 3,12.5, '$3.3 per 1L | Was $16.85', 0);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Red Bull Energy Drink 4X250mL | 4 pack', 7,3, 12, '$12 per 1L', 0);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Coles Full Cream Milk | 3L', 8,4, 4.5, '$1.5 per 1L', 25);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Westgold Salted Butter | 400g', 9,4, 8.5, '$1.45 per 100g', 3);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Castello Double Cream Brie Chilli | 150g', 9, 4,7.5, '$50 per 1kg', 63);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Coles Squeezie Strawberry Yoghurt Pouch | 70g', 9,4, 0.75, '$1.7 per 100g', 96);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('French Onion Dip | 200g', 9,4, 2.4, '$1.2per 100g', 0);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Dairy Farmers Thickened Cream | 300mL', 9, 4,3.4, '$1.13per 100ml', 63);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Sanitarium Up&Go Liquid Breakfast Strawberry Fridg 3L', 9, 4,17.5, '$5.83 per 1L', 233);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('QV Baby Moisturising Cream | 500g', 10,5, 12.50, '$2.50 per 100g | Was $25.00', 22);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('CUB Nappy Bags | 200 pack', 10, 5,3.20, '$1.60 per 100ea', 2);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Little Bellies Baby Puffs Carrot | 12g', 11,5, 2.00, '$16.67 per 100g', 21);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Cinnamon Baby Puffs | 12g', 11,5, 2.00, '$16.67 per 100g', 55);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Baby Mum-Mum Rice Rusks Banana +8 Months | 36g', 11,5, 3.85, '$10.69 per 100g', 8);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Heinz Banana Custard Pouch 6+ Months | 120g', 10,5, 1.50, '$1.25 per 100g', 15);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Lamb Cutlets | approx 775g', 13,6, 33.33, '$43.00 per 1kg', 15);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Coles Lamb Loin Chops | approx 500g', 13, 6,14.00, '$28.00 per 1kg', 15);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('No Added Hormone Beef Porterhouse 450g', 12,6, 18.00, '$40.00 per 1kg', 15);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ('Cooked Prawns With Cocktail Sauce | 260g', 14,6, 12.50, '$48.08 per 1kg', 15);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ("KB's Tuna Steaks | 200g", 14,6, 11.00, '$55.00 per 1kg', 15);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ("Woofin Chicken Rice & Veg Dog Food | 720g", 16, 7,3.40, '$0.47 per 100g', 15);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ("Ocean Fish Wet Cat Food 85g 7 pack", 15, 7,9.00, '$1.51 per 100g', 15);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ("Woofin Lamb Rice & Vegetables 400g", 16, 7,2.40, '$0.47 per 100g', 15);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ("Peters Brunch Rabbit & Guinea Pig Food | 450g", 17, 7,15.50, '$0.47 per 100g', 15);
INSERT INTO Products (product_name, sub_category_id, category_id,price, description, stock_quantity) VALUES ("Peters Oaten Hay Rabbit & Guinea Pig Food | 1 kg", 17, 7,14.80, '$1.48 per 100g', 15);


INSERT INTO Cart ( product_id, quantity) VALUES ( 2, 3);
INSERT INTO Cart ( product_id, quantity) VALUES ( 3, 1);

INSERT INTO Orders (order_date, total_amount, status) VALUES ('2023-10-15', 56.99, 'Completed');

INSERT INTO OrderDetails (order_id, product_id, quantity, subtotal) VALUES (1, 1, 2, 11.98);
INSERT INTO OrderDetails (order_id, product_id, quantity, subtotal) VALUES (1, 2, 1, 3.49);


