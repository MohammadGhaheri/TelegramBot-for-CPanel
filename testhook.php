<?php
$bot_api_key = 'BOT_API_TOKEN';  // توکن ربات رو اینجا بذار

$url = "https://api.telegram.org/bot$bot_api_key/getWebhookInfo";

$response = file_get_contents($url);
if ($response === FALSE) {
    echo "خطا در دریافت اطلاعات webhook";
    exit;
}

$data = json_decode($response, true);
echo "<pre>";
print_r($data);
echo "</pre>";