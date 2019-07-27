<?php

namespace Tests\Payload\Converters;

use PHPUnit\Framework\TestCase;
use TimKippDev\SlackNotifier\SlackField;
use TimKippDev\SlackNotifier\Payload\Converters\SlackFieldConverter;

class SlackFieldConverterTest extends TestCase {

    /** @var SlackFieldConverter */
    private $slackFieldConverter;

    protected function setUp()
    {
        parent::setUp();

        $this->slackFieldConverter = new SlackFieldConverter();
    }

    public function test_convert()
    {
        $slackField = new SlackField();
        $slackField->setTitle('title')
            ->setValue('value')
            ->setShort(true);
            
        $data = $this->slackFieldConverter->convert($slackField);

        $this->assertArrayHasKey('title', $data);
        $this->assertArrayHasKey('value', $data);
        $this->assertArrayHasKey('short', $data);
        
        $this->assertEquals($slackField->getTitle(), $data['title']);
        $this->assertEquals($slackField->getValue(), $data['value']);
        $this->assertEquals($slackField->getShort(), $data['short']);
    }

}