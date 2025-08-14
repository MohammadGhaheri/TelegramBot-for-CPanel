<?php
require __DIR__ . '/vendor/autoload.php';

use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Exception\TelegramException;

$bot_api_key  = 'BOT_API_TOKEN';
$bot_username = 'BOT_USERNAME';
$hook_url     = 'https://YOUR_PUBLIC_WEB_ADDRESS/webhook.php';  // آدرس کامل و HTTPS فایل webhook.php

try {
    $telegram = new Telegram($bot_api_key, $bot_username);
    $result = $telegram->setWebhook($hook_url);
    if ($result->isOk()) {
        echo 'Webhook set: ' . $result->getDescription();
    } else {
        echo 'Failed to set webhook: ' . $result->getDescription();
    }
} catch (TelegramException $e) {
    echo 'Error: ' . $e->getMessage();
}
