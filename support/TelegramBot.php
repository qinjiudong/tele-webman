<?php

namespace support;

use GuzzleHttp\Client;

class TelegramBot
{
    private Client $client;

    public function __construct()
    {
        $token = getenv('TELEGRAM_BOT_TOKEN');
        $baseUrl = "https://api.telegram.org/bot{$token}/";
        $this->client = new Client(['base_uri' => $baseUrl, 'verify' => false]);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function api($method, $params = [])
    {
        $response = $this->client->request('POST', $method, ['json' => $params]);
        $body = $response->getBody()->getContents();
        return json_decode($body, true);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendMessage($chatId, $text, $parseMode)
    {
        $params = ['chat_id' => $chatId, 'text' => $text, 'parse_mode' => $parseMode];
        return $this->api('sendMessage', $params);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function editMessageText($chatId, $text, $parseMode, $messageId)
    {
        $params = ['chat_id' => $chatId, 'text' => $text, 'parse_mode' => $parseMode, 'message_id' => $messageId];
        return $this->api('editMessageText', $params);
    }
}