# 🛒 Grocery Billing System

A simple and complete **web-based grocery billing system** built with PHP, MySQL, and JavaScript. This system allows shop owners to manage product stock and generate printable customer bills instantly.

---

## 📸 Project Overview

| Page | Description |
|------|-------------|
| **Login** | Secure admin login with session |
| **Stock Management** | Add, edit products with price & stock |
| **Billing** | Dynamic multi-item bill generation |
| **Print Bill** | Printable invoice with grand total |

---

## ✨ Features

- 🔐 Admin login with session authentication
- 📦 Product stock management (Add / Edit)
- 🧾 Dynamic billing — add multiple rows, auto-calculate subtotal & total
- 📉 Auto stock deduction after billing
- 🖨️ Printable bill / invoice page
- 📱 Clean responsive UI with CSS

---

## 🗂️ Project File Structure

```
grocery-billing-system/
│
├── index.php          → Login page
├── stock.php          → Stock management (Add / Edit products)
├── billing.php        → Billing page (select products & quantities)
├── billing.js         → JavaScript for dynamic row & calculation
├── print_bill.php     → Printable invoice/bill
├── logout.php         → Session destroy & logout
├── db.php             → MySQL database connection
├── style.css          → All page styles
└── README.md          → This file
```

---

## 🛠️ Tech Stack

| Technology | Usage |
|------------|-------|
| PHP 7+     | Backend logic & session management |
| MySQL      | Database (products table) |
| JavaScript | Dynamic billing rows & calculations |
| CSS3       | Responsive styling |
| HTML5      | Page structure |

---

## ⚙️ Database Setup

### Step 1 — Create Database

Open **phpMyAdmin** or run this in MySQL terminal:

```sql
CREATE DATABASE grocery_db;
USE grocery_db;
```

### Step 2 — Create Products Table

```sql
CREATE TABLE products (
    id    INT AUTO_INCREMENT PRIMARY KEY,
    name  VARCHAR(100) NOT NULL,
    unit  VARCHAR(20) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock DECIMAL(10,2) NOT NULL
);
```

### Step 3 — (Optional) Insert Sample Data

```sql
INSERT INTO products (name, unit, price, stock) VALUES
('Rice',   'Kg',   45.00, 100),
('Sugar',  'Kg',   42.00, 50),
('Oil',    'Litre',130.00, 30),
('Salt',   'Pack', 20.00, 80),
('Biscuit','Pcs',  10.00, 200);
```

---

## 🚀 Local Deployment (XAMPP / WAMP)

### Prerequisites

- [XAMPP](https://www.apachefriends.org/) or [WAMP](https://www.wampserver.com/) installed
- PHP 7.4+ and MySQL included

---

### Step-by-Step Setup

#### ✅ Step 1 — Install XAMPP

Download and install XAMPP from: https://www.apachefriends.org/

#### ✅ Step 2 — Copy Project Files

Copy the entire project folder into:

```
C:\xampp\htdocs\grocery-billing-system\
```

*(On Mac/Linux: `/opt/lampp/htdocs/grocery-billing-system/`)*

#### ✅ Step 3 — Start XAMPP Services

Open **XAMPP Control Panel** and start:
- ✅ Apache
- ✅ MySQL

#### ✅ Step 4 — Create the Database

1. Open browser → go to `http://localhost/phpmyadmin`
2. Click **New** → Database name: `grocery_db` → Click **Create**
3. Click on **SQL** tab and paste the table creation query from above
4. Click **Go**

#### ✅ Step 5 — Run the Project

Open your browser and visit:

```
http://localhost/grocery-billing-system/
```

#### ✅ Step 6 — Login

```
Username: admin
Password: 12345
```

---

## ☁️ Live / Online Deployment (Shared Hosting)

### Prerequisites
- A hosting account with PHP + MySQL support (e.g., Hostinger, InfinityFree, 000webhost)
- FTP client like [FileZilla](https://filezilla-project.org/)

### Step-by-Step

#### ✅ Step 1 — Create MySQL Database on Hosting Panel
1. Go to **cPanel → MySQL Databases**
2. Create a new database (e.g., `grocery_db`)
3. Create a database user and assign it to the database with **All Privileges**

#### ✅ Step 2 — Update db.php

Edit `db.php` with your hosting credentials:

```php
$host   = "localhost";         // usually stays localhost
$user   = "your_db_username";
$pass   = "your_db_password";
$dbname = "your_db_name";
```

#### ✅ Step 3 — Import Database

1. Open **cPanel → phpMyAdmin**
2. Select your database
3. Click **SQL** tab → paste and run the `CREATE TABLE` query

#### ✅ Step 4 — Upload Files via FTP

1. Open FileZilla
2. Connect to your hosting FTP
3. Upload all project files to `public_html/` or a subfolder

#### ✅ Step 5 — Access Your Site

```
https://yourdomain.com/
```

---

## 🔑 Default Login Credentials

> ⚠️ Change these before deploying to production!

```
Username: admin
Password: 12345
```

These are hardcoded in `index.php`. For production, store credentials in the database with hashed passwords.

---

## ⚠️ Known Limitations & Security Notes

| Issue | Recommendation |
|-------|----------------|
| Hardcoded login credentials | Move to database with `password_hash()` |
| SQL Injection risk in queries | Use **PDO / Prepared Statements** |
| No delete product feature | Can be added with a delete button + SQL `DELETE` |
| No bill history saved | Add a `bills` table to store past transactions |
| Single admin user only | Add a `users` table for multi-user support |

---

## 📋 How the System Works (Flow)

```
Login (index.php)
    ↓
Stock Management (stock.php)
  → Add new products
  → Edit existing products
    ↓
Billing (billing.php)
  → Select products & enter quantity
  → JS auto-calculates subtotal & total
  → Click "Generate & Print Bill"
    ↓
Print Bill (print_bill.php)
  → Shows invoice
  → Stock auto-deducted
  → Click "Print Bill" to print
    ↓
Logout (logout.php)
```

---

## 👨‍💻 Author

**Ayan Ghosh**

Built as a PHP + MySQL project for a functional grocery shop billing and stock management system.

---

## 🌐 Live Demo

🔗 [ayangrocery.infinityfreeapp.com](http://ayangrocery.infinityfreeapp.com)

---

## 📄 License

This project is open source and free to use for learning and personal projects.
