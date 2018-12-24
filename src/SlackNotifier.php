<?php

namespace HidalgoRides\SlackNotifier;

use GuzzleHttp\Client;
use HidalgoRides\SlackNotifier\SlackField;
use HidalgoRides\SlackNotifier\SlackAction;
use HidalgoRides\SlackNotifier\SlackAttachment;
use HidalgoRides\SlackNotifier\SlackPayloadGenerator;

class SlackNotifier {

    /** @var Client */
    private $client;

    /** @var SlackPayloadGenerator */
    private $payloadGenerator;

    private $webhookURL;

    public function __construct($webhookURL)
    {
        $this->client = new Client();
        $this->payloadGenerator = new SlackPayloadGenerator();
        $this->webhookURL = $webhookURL;
    }

    public function sendMessage($message, array $attachments = [])
    {
        $this->send($message, $attachments);
    }

    private function send($message, array $attachments)
    {
        $payload = $this->payloadGenerator->generate($message, $attachments);

        $this->client->request('POST', $this->webhookURL, [
            'json' => $payload
        ]);
    }

}