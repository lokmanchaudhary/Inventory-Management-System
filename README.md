# Inventory Management System

A Laravel-based Inventory Management System designed to help businesses manage their products in detail — including exchanged items, non-refundable products, sales performance tracking, tax invoice handling, and more.

---

## 🚧 Project Status

**Work in Progress**

- The `main` branch contains the **stable version**.
- Active development happens on the `dev` branch.
- Currently working on:
    - Tax Invoice system (supports different seller formats)
    - Employee routes for frontend access
    - In-system notifications

---

## 🧰 Tech Stack

- **Backend:** Laravel
- **Admin Panel:** FilamentPHP
- **Database:** MySQL
- **Email:** Mailpit (for local email testing)
- **Dev Tools:** Laravel Sail, Docker (optional but recommended)

---

## 📁 Models Implemented So Far

- `Admin`
- `Category`
- `DamagedProduct`
- `NonRefundableNonExchangeable`
- `Product`
- `ProductExchange`
- `RefundedProduct`
- `SalesPerformanceReport`
- `Seller`
- `SubCategory`
- `TaxInvoice`
- `User`

> These models help track every crucial aspect of inventory, from product exchanges to tax invoices in varying formats used by different sellers.

---

## 🚀 Installation & Setup

1. **Clone the repo:**
   ```bash
   git clone https://github.com/lokmanchaudhary/Inventory-Management-System
   cd inventory-management-system
   ```

2. **Copy `.env` file and configure database:**
   ```bash
   cp .env.example .env
   ```

3. **Set up using Laravel Sail (recommended):**
   ```bash
   ./vendor/bin/sail up
   ```

4. **Run migrations and seed (if any):**
   ```bash
   ./vendor/bin/sail artisan migrate
   ```

5. **Create an admin user for Filament Panel:**
   ```bash
   ./vendor/bin/sail artisan make:filament-user
   ```

6. **Access Filament Admin Panel:**
   Visit [http://localhost/admin](http://localhost/admin) in your browser.

---

## 🔄 Branches

- `main`: Stable release — production-ready code.
- `dev`: Development branch — active work and new features.

---

## 📦 Planned Features

- Frontend employee panel with role-based routing
- In-app system notifications
- Advanced profit calculations
- Exportable reports and dashboards

---

## 🤝 Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

---

## 📬 Contact

Feel free to reach out for feedback or questions:

**Email:** [lokmanchaudhary00@gmail.com](mailto:lokmanchaudhary00@gmail.com)
