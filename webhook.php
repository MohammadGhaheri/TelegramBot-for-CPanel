<?php
// فعال کردن گزارش خطا (فقط برای توسعه)
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Exception\TelegramException;

// ===== تنظیمات بات =====
$bot_api_key  = 'BOT_API_TOKEN';
$bot_username = 'BOT_USERNAME';

// ===== تنظیمات دیتابیس (اختیاری) =====
$mysql_credentials = [
   'host'     => 'localhost',
   'port'     => 3306,
   'user'     => 'mysql_db_user',
   'password' => 'mysql_User_password',
   'database' => 'mysql_Username',
];

// ===== مسیر فایل‌های لاگ =====
$log_path = __DIR__ . '/logs';
if (!is_dir($log_path)) {
    mkdir($log_path, 0777, true);
}

try {
    // لاگ شروع
    file_put_contents($log_path . '/exception.log', ">>> Bot start " . date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);

    // ساخت شیء ربات
    $telegram = new Telegram($bot_api_key, $bot_username);

    // مسیر دستورات سفارشی
    $telegram->addCommandsPath(__DIR__ . '/Commands/UserCommands');

    // فعال کردن دیتابیس
    $telegram->enableMySql($mysql_credentials);

    // ===== لاگ کامل تمام آپدیت‌ها =====
    $update_content = file_get_contents('php://input');
    file_put_contents($log_path . '/exception.log', "RAW UPDATE: " . $update_content . PHP_EOL, FILE_APPEND);


$commands = $telegram->getCommandsList();
file_put_contents($log_path . '/exception.log', "Commands loaded: " . implode(',', array_keys($commands)) . PHP_EOL, FILE_APPEND);


    // پردازش آپدیت‌ها
    $telegram->handle();

    file_put_contents($log_path . '/exception.log', "Handled update" . PHP_EOL, FILE_APPEND);

} catch (TelegramException $e) {
    file_put_contents($log_path . '/exception.log', "TelegramException: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
} catch (Exception $e) {
    file_put_contents($log_path . '/exception.log', "Exception: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
}
