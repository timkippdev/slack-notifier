<?php

namespace HidalgoRides\SlackNotifier;

use GuzzleHttp\Client;
use HidalgoRides\SlackNotifier\SlackField;
use HidalgoRides\SlackNotifier\SlackAction;
use HidalgoRides\SlackNotifier\SlackAttachment;
use HidalgoRides\SlackNotifier\Payload\SlackPayloadGenerator;

class SlackNotifier {

    /** @var Client */
    private $client;

    /** @var SlackPayloadGenerator */
    private $slackPayloadGenerator;

    private $webhookURL;

    public function __construct($webhookURL)
    {
        $this->client = new Client();
        $this->slackPayloadGenerator = new SlackPayloadGenerator();
        $this->webhookURL = $webhookURL;
    }

    public function getClient() : Client
    {
        return $this->client;
    }

    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    public function getSlackPayloadGenerator() : SlackPayloadGenerator
    {
        return $this->slackPayloadGenerator;
    }

    public function setSlackPayloadGenerator(SlackPayloadGenerator $slackPayloadGenerator)
    {
        $this->slackPayloadGenerator = $slackPayloadGenerator;
    }

    public function sendMessage($message, array $attachments = [])
    {
        $this->send($message, $attachments);
    }

    private function send($message, array $attachments)
    {
        $payload = $this->slackPayloadGenerator->generate($message, $attachments);

        $this->client->request('POST', $this->webhookURL, [
            'json' => $payload
        ]);
    }

}