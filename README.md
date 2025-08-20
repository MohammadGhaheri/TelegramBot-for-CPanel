📖 آموزش نصب و راه‌اندازی ربات تلگرام برای هاست های Cpanel اشتراکی
اگه سوالی داشتین می تونین با من تماس بگیرید:
mohammad.ghaheri@gmail.com
[https://www.linkedin.com/in/moahammadghaheri
](https://www.linkedin.com/in/mohammadghaheri/)
[https://www.youtube.com/mohammadghaheri](https://www.youtube.com/mohammadghaheri)

این پروژه برای کاربرانی آماده شده که می‌خواهند بدون نیاز به Composer یا خط فرمان، ربات تلگرام را روی هاست Cpanel اجرا کنند.

## پیش‌نیازها

* هاست با PHP 7.4 یا بالاتر
* دامنه با SSL فعال (https)
* یک ربات ساخته شده از طریق [BotFather](https://t.me/BotFather)

## مراحل نصب

### ۱. آپلود فایل‌ها

* پوشه پروژه را روی هاست (مثلاً مسیر `/public_html/tgbot`) آپلود کنید.
* مطمئن شوید فایل‌های زیر وجود دارند:

  * `webhook.php`
  * `setwebhook.php`
  * `testhook.php`
  * پوشه `Commands/`

### ۲. تنظیم فایل‌ها

سه فایل اصلی باید با اطلاعات ربات شما تنظیم شوند:

* **`setwebhook.php`**

  * توکن ربات (Bot API Key) را از BotFather بگیرید و جایگزین کنید.
  * آدرس دامنه خود (مثلاً `https://yourdomain.com/tgbot/webhook.php`) را وارد کنید.

* **`webhook.php`**

  * اطلاعات دیتابیس MySQL (هاست، یوزر، پسورد، نام دیتابیس) را جایگزین کنید.

* **`testhook.php`**

  * در این فایل هم Bot API Key و Username ربات را وارد کنید.

### ۳. ساخت دیتابیس

* در Cpanel یک دیتابیس جدید بسازید.
* یک یوزر تعریف کنید و به دیتابیس دسترسی کامل بدهید.
* اطلاعات دیتابیس را در `webhook.php` وارد کنید.

### ۴. ست کردن Webhook

* در مرورگر خود باز کنید:

  ```
  https://yourdomain.com/tgbot/setwebhook.php
  ```
* اگر درست تنظیم شده باشد، پیام موفقیت دریافت می‌کنید.

### ۵. تست درست ست شدن Webhook ربات

* برای اطمینان می‌توانید این آدرس را باز کنید:

  ```
  https://yourdomain.com/tgbot/testhook.php
  ```
* یا مستقیماً به ربات پیام دهید (مثلاً `start/` یا یک پیام معمولی).

---

# 📖 Telegram Bot Setup Guide (English)وب 

This project is designed for users who want to set up a Telegram bot on a shared hosting (Cpanel) **without Composer or command line**.

## Requirements

* Hosting with PHP 7.4+
* Domain with SSL (https)
* A Telegram bot created via [BotFather](https://t.me/BotFather)

## Installation Steps

### 1. Upload files

* Upload the project folder to your hosting (e.g., `/public_html/tgbot`).
* Make sure the following files exist:

  * `webhook.php`
  * `setwebhook.php`
  * `testhook.php`
  * `Commands/` folder

### 2. Configure files

Edit the following files manually:

* **`setwebhook.php`**

  * Insert your Bot API Key from BotFather.
  * Set your domain URL (e.g., `https://yourdomain.com/tgbot/webhook.php`).

* **`webhook.php`**

  * Add your MySQL database credentials (host, user, password, database).

* **`testhook.php`**

  * Enter your Bot API Key and bot username.

### 3. Create a database

* In Cpanel, create a new MySQL database.
* Add a user and grant full privileges.
* Use this information inside `webhook.php`.

### 4. Set the webhook

* Open in your browser:

  ```
  https://yourdomain.com/tgbot/setwebhook.php
  ```
* You should see a success message if everything is correct.

### 5. Test if Webhook is set

* Open in browser:

  ```
  https://yourdomain.com/tgbot/testhook.php
  ```
* Or simply send a message to your bot (e.g., `/start` or any text).


DB Creation Query:

-- جدول کاربران با نقش و شرکت
CREATE TABLE `bi_users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `telegram_id` BIGINT NOT NULL UNIQUE, -- chat_id یا user_id
    `first_name` VARCHAR(100),
    `last_name` VARCHAR(100),
    `username` VARCHAR(100),
    `company` VARCHAR(100),               -- مثلا alpha, beta, ...
    `role` VARCHAR(50),                   -- مثلا SalesManager, TopHead
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- جدول داده‌های ذخیره‌شده (SaveData)
CREATE TABLE `bi_saved_data` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `data_key` VARCHAR(100) NOT NULL,     -- کلید یا نام گزارش
    `data_value` TEXT NOT NULL,           -- داده ذخیره‌شده (JSON یا متن)
    `created_by` BIGINT,                  -- telegram_id کاربری که ذخیره کرده
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`created_by`) REFERENCES `bi_users` (`telegram_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- جدول پیام‌های ارسال مستقیم (DirectSend)
CREATE TABLE `bi_direct_messages` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `target_group` VARCHAR(50) NOT NULL,  -- SalesManager, TopHead, ...
    `target_company` VARCHAR(100) NOT NULL, -- alpha, beta, All
    `raw_message` TEXT NOT NULL,          -- متن خام پیام
    `sent_by` BIGINT,                     -- telegram_id ارسال‌کننده
    `sent_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`sent_by`) REFERENCES `bi_users` (`telegram_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


