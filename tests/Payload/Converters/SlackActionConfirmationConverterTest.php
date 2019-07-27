<?php

namespace Tests\Payload\Converters;

use PHPUnit\Framework\TestCase;
use TimKippDev\SlackNotifier\SlackActionConfirmation;
use TimKippDev\SlackNotifier\Payload\Converters\SlackActionConfirmationConverter;

class SlackActionConfirmationConverterTest extends TestCase {

    /** @var SlackActionConfirmationConverter */
    private $slackActionConfirmationConverter;

    protected function setUp()
    {
        parent::setUp();

        $this->slackActionConfirmationConverter = new SlackActionConfirmationConverter();
    }

    public function test_convert()
    {
        $slackActionConfirmation = new SlackActionConfirmation();
        $slackActionConfirmation->setDismissButtonText('dismiss')
            ->setOkButtonText('ok')
            ->setText('text')
            ->setTitle('title');
            
        $data = $this->slackActionConfirmationConverter->convert($slackActionConfirmation);

        $this->assertIsArray($data);
        $this->assertArrayHasKey('dismiss_text', $data);
        $this->assertArrayHasKey('ok_text', $data);
        $this->assertArrayHasKey('text', $data);
        $this->assertArrayHasKey('title', $data);

        $this->assertEquals($slackActionConfirmation->getDismissButtonText(), $data['dismiss_text']);
        $this->assertEquals($slackActionConfirmation->getOkButtonText(), $data['ok_text']);
        $this->assertEquals($slackActionConfirmation->getText(), $data['text']);
        $this->assertEquals($slackActionConfirmation->getTitle(), $data['title']);
    }

}