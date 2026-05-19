<?php

namespace app\controller;

use support\Request;
use support\TelegramBot;

class IndexController
{
    public function index(Request $request)
    {

    }

    public function sendMessage(Request $request)
    {
        $chatId = $request->input('chat_id', '-1003948380913');
        $text = $request->input('text');
        $parseMode = $request->input('parse_mode', 'html');
        $bot = new TelegramBot();
        $res = $bot->sendMessage($chatId, $text, $parseMode);
        return json($res);
    }

    public function json(Request $request)
    {
        return json(['code' => 0, 'msg' => 'ok']);
    }

}
