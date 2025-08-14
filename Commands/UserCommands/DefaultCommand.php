<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;

class DefaultCommand extends UserCommand
{
    protected $name = 'default';
    protected $description = 'Handle all messages that don’t match any command';
    protected $version = '1.0.0';

    public function execute(): ServerResponse
    {
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();
        $text = $message->getText();

        return Request::sendMessage([
            'chat_id' => $chat_id,
            'text'    => "پیام شما دریافت شد: $text",
        ]);
    }
}
