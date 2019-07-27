<?php

namespace Tests;

use GuzzleHttp\Client;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use TimKippDev\SlackNotifier\SlackNotifier;
use TimKippDev\SlackNotifier\Payload\SlackPayloadGenerator;
use TimKippDev\SlackNotifier\SlackAttachment;

class SlackNotifierTest extends TestCase {

    private static $TEST_WEBHOOK_URL = 'https://unit-test.com';

    /** @var SlackNotifier */
    private $notifier;

    /** @var MockInterface */
    private $clientMock;

    /** @var MockInterface */
    private $slackPayloadGeneratorMock;

    protected function setUp()
    {
        parent::setUp();

        $this->clientMock = \Mockery::mock(Client::class);
        $this->slackPayloadGeneratorMock = \Mockery::mock(SlackPayloadGenerator::class);

        $this->notifier = new SlackNotifier(self::$TEST_WEBHOOK_URL);
        $this->notifier->setClient($this->clientMock);
        $this->notifier->setSlackPayloadGenerator($this->slackPayloadGeneratorMock);
    }

    protected function tearDown()
    {
        \Mockery::close();
    }

    public function test_sendMessage()
    {
        $payload = [
            'unit' => 'test'
        ];

        $this->slackPayloadGeneratorMock
            ->shouldReceive('generate')
            ->times(1)
            ->with('message', [])
            ->andReturn($payload);

        $this->clientMock
            ->shouldReceive('request')
            ->times(1)
            ->with('POST', self::$TEST_WEBHOOK_URL, ['json' => $payload]);

        $this->notifier->sendMessage('message');

        $this->assertTrue(true);
    }

    public function test_sendMessageWithAttachments()
    {
        $payload = [
            'unit' => 'test'
        ];

        $attachments = [
            new SlackAttachment()
        ];

        $this->slackPayloadGeneratorMock
            ->shouldReceive('generate')
            ->times(1)
            ->with('message', $attachments)
            ->andReturn($payload);
            
        $this->clientMock
            ->shouldReceive('request')
            ->times(1)
            ->with('POST', self::$TEST_WEBHOOK_URL, ['json' => $payload]);

        $this->notifier->sendMessage('message', $attachments);

        $this->assertTrue(true);
    }

}