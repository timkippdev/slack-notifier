<?php

namespace Tests\Payload\Converters;

use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use TimKippDev\SlackNotifier\SlackAction;
use TimKippDev\SlackNotifier\SlackActionConfirmation;
use TimKippDev\SlackNotifier\Payload\Converters\SlackActionConverter;
use TimKippDev\SlackNotifier\Payload\Converters\SlackActionConfirmationConverter;

class SlackActionConverterTest extends TestCase {

    /** @var SlackActionConverter */
    private $slackActionConverter;

    /** @var MockInterface */
    private $slackActionConfirmationConverterMock;

    protected function setUp()
    {
        parent::setUp();

        $this->slackActionConfirmationConverterMock = \Mockery::mock(SlackActionConfirmationConverter::class);

        $this->slackActionConverter = new SlackActionConverter();
        $this->slackActionConverter->setSlackActionConfirmationConverter($this->slackActionConfirmationConverterMock);
    }

    public function test_convert()
    {
        $slackActionConfirmation = new SlackActionConfirmation();
        $slackActionConfirmation->setDismissButtonText('dismiss')
            ->setOkButtonText('ok')
            ->setText('text')
            ->setTitle('title');

        $slackAction = new SlackAction();
        $slackAction->setStyle('primary')
            ->setType('button')
            ->setText('text')
            ->setUrl('https://unit-test.com')
            ->setName('name')
            ->setConfirmation($slackActionConfirmation);

        $this->slackActionConfirmationConverterMock
            ->shouldReceive('convert')
            ->with($slackActionConfirmation)
            ->andReturn([
                ['data']
            ]);
            
        $data = $this->slackActionConverter->convert($slackAction);

        $this->assertArrayHasKey('confirm', $data);
        $this->assertArrayHasKey('name', $data);
        $this->assertArrayHasKey('style', $data);
        $this->assertArrayHasKey('text', $data);
        $this->assertArrayHasKey('type', $data);
        $this->assertArrayHasKey('url', $data);

        $this->assertEquals($slackAction->getName(), $data['name']);
        $this->assertEquals($slackAction->getStyle(), $data['style']);
        $this->assertEquals($slackAction->getText(), $data['text']);
        $this->assertEquals($slackAction->getType(), $data['type']);
        $this->assertEquals($slackAction->getUrl(), $data['url']);
    }

}