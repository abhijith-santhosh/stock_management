# Stock Movement Management System

A Laravel-based inventory stock movement management system that handles:

- Purchase
- Sale
- Sale Return
- Purchase Return

The system maintains stock consistency using database transactions and prevents negative stock balances.

---

## Requirements

- PHP 8.2+
- Laravel 12
- MySQL

---

## Installation

### Clone Repository

```bash
git clone https://github.com/abhijith-santhosh/stock_management.git
cd stock_management
```

### Install Dependencies

```bash
composer install
```

### Configure Environment

```bash
cp .env.example .env
```

Update database credentials in `.env`.

### Generate Application Key

```bash
php artisan key:generate
```

### Run Migrations

```bash
php artisan migrate
```

### Seed Sample Data

```bash
php artisan db:seed
```

### Start Development Server

```bash
php artisan serve
```

---

## API Endpoints

### Create Stock Movement

```http
POST /api/stock-movements
```

### Get Current Stock

```http
GET /api/products/{id}/stock
```

### Get Stock Movement History

```http
GET /api/products/{id}/stock-movements
```

---

## Sample Request - Purchase

```json
{
    "product_id": 1,
    "movement_type": "purchase",
    "quantity": 100,
    "reference_no": "PUR-001",
    "notes": "Initial stock purchase"
}
```

---

## Sample Request - Sale

```json
{
    "product_id": 1,
    "movement_type": "sale",
    "quantity": 20,
    "reference_no": "SAL-001",
    "notes": "Customer order"
}
```

---

## Business Rules

- Stock cannot go below zero.
- Duplicate reference numbers are not allowed.
- All stock operations are executed inside a database transaction.
- Inventory movements are stored for audit purposes.
- Current stock is maintained separately for faster retrieval.

---

## Author

Abhijith Santhosh
