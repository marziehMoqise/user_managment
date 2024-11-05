
# Laravel API Project

پروژه‌ای برای مدیریت کاربران و کشورها با استفاده از API‌های ساخته‌شده در Laravel.

## نصب و راه‌اندازی

### 1. نصب وابستگی‌ها

برای نصب وابستگی‌های مورد نیاز پروژه از دستور زیر استفاده کنید:

```bash
composer install
```

### 2. تنظیم فایل `.env`

یک فایل `.env` ایجاد کنید و اطلاعات دیتابیس و سایر تنظیمات را در آن وارد کنید:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 3. اجرای مهاجرت‌ها و ساخت جداول

برای ساخت جداول دیتابیس و ورود اطلاعات اولیه، از دستور زیر استفاده کنید:

```bash
php artisan migrate --seed
```

### 4. اجرای سرور محلی

برای اجرای سرور محلی و تست API از دستور زیر استفاده کنید:

```bash
php artisan serve
```

سرور به طور پیش‌فرض در [http://localhost:8000](http://localhost:8000) در دسترس خواهد بود.

## مستندات API

### مسیرهای اصلی

- **GET /api/users**: دریافت لیست کاربران
- **POST /api/users**: ایجاد کاربر جدید
- **PUT /api/users/{id}**: ویرایش کاربر مشخص‌شده
- **DELETE /api/users/{id}**: حذف کاربر مشخص‌شده
- **GET /api/countries**: دریافت لیست کشورها و واحدهای پولی مربوطه

## مثال‌های درخواست API

### ایجاد کاربر جدید

مثال یک درخواست برای ایجاد کاربر جدید:

```http
POST /api/users
Content-Type: application/json

{
    "name": "John Doe",
    "email": "john@example.com",
    "country": "Iran",
    "currency": "IRR"
}
```

### به‌روزرسانی کاربر

درخواست به‌روزرسانی اطلاعات یک کاربر مشخص‌شده با آیدی:

```http
PUT /api/users/{id}
Content-Type: application/json

{
    "name": "Updated Name",
    "email": "john@example.com",
    "country": "Iran",
    "currency": "IRR"
}
```

### دریافت لیست کشورها

برای دریافت لیست کشورها و واحدهای پولی مرتبط، می‌توانید از این درخواست استفاده کنید:

```http
GET /api/countries
```

## اجرای تست‌ها

برای اجرای تست‌ها، از دستور زیر استفاده کنید:

```bash
php artisan test
```

این دستور تست‌های تعریف‌شده در پوشه `tests` را اجرا کرده و نتیجه را نمایش می‌دهد.
