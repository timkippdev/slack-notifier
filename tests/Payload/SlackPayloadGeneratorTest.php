<?php

namespace Tests\Payload;

use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use TimKippDev\SlackNotifier\SlackField;
use TimKippDev\SlackNotifier\SlackAction;
use TimKippDev\SlackNotifier\SlackAttachment;
use TimKippDev\SlackNotifier\SlackActionConfirmation;
use TimKippDev\SlackNotifier\Payload\SlackPayloadGenerator;
use TimKippDev\SlackNotifier\Payload\Converters\SlackAttachmentConverter;

class SlackPayloadGeneratorTest extends TestCase {

    /** @var SlackPayloadGenerator */
    private $slackPayloadGenerator;

    /** @var MockInterface */
    private $slackAttachmentConverterMock;

    protected function setUp()
    {
        parent::setUp();

        $this->slackAttachmentConverterMock = \Mockery::mock(SlackAttachmentConverter::class);

        $this->slackPayloadGenerator = new SlackPayloadGenerator();
        $this->slackPayloadGenerator->setSlackAttachmentConverter($this->slackAttachmentConverterMock);
    }

    public function test_verifyPayloadFields_noAttachments()
    {
        $payload = $this->slackPayloadGenerator->generate('message');

        $this->assertNotNull($payload);
        $this->assertArrayHasKey('text', $payload);
        $this->assertEquals('message', $payload['text']);
    }

    public function test_verifyPayloadFields_withAttachments()
    {
        $slackAttachment = new SlackAttachment();

        $this->slackAttachmentConverterMock
            ->shouldReceive('convert')
            ->with($slackAttachment)
            ->times(1)
            ->andReturn([
                ['data']
            ]);

        $payload = $this->slackPayloadGenerator->generate('message', [
            $slackAttachment
        ]);

        $this->assertNotNull($payload);
        $this->assertArrayHasKey('text', $payload);
        $this->assertArrayHasKey('attachments', $payload);
        
        $attachments = $payload['attachments'];
        $this->assertIsArray($attachments);
        $this->assertCount(1, $attachments);
    }

}