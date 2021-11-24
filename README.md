## Stock Trader Application

---

### Functionality:

- View company profile
- Sell stocks
- Buy stocks
- View / Manage your own portfolio
- Stock Market works between 16:00 and 23:00 (Mon-Fri)
- User recieves email on stock sell and stock purchase

### Requirements:

- PHP 7.4+
- MySQL 5.7+
- Composer
- Node.js
- [FINNHUB API](https://finnhub.io) account
- (Optional) [Mailtrap account](https://mailtrap.io)

### Step by step installation:

- Run `composer install` in main project directory
- Run `npm install` in main project directory
- Create copy of .env.example and rename it to .env
- Set up your database connection within .env (DB_USERNAME & DB_PASSWORD)
- Run `php artisan migrate`
- Set up your MAIL configuration within .env
- Provide FINNHUB API key within .env
- (Optional) Create Mailtrap account and use it for MAIL configuration

### How to run:

- Run `php artisan server`
- Run `php artisan queue:listen`
