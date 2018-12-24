<?php

namespace Tests\Payload\Converters;

use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use HidalgoRides\SlackNotifier\SlackField;
use HidalgoRides\SlackNotifier\SlackAction;
use HidalgoRides\SlackNotifier\SlackAttachment;
use HidalgoRides\SlackNotifier\Payload\Converters\SlackFieldConverter;
use HidalgoRides\SlackNotifier\Payload\Converters\SlackActionConverter;
use HidalgoRides\SlackNotifier\Payload\Converters\SlackAttachmentConverter;

class SlackAttachmentConverterTest extends TestCase {

    /** @var SlackAttachmentConverter */
    private $slackAttachmentConverter;

    /** @var MockInterface */
    private $slackActionConverterMock;

    /** @var MockInterface */
    private $slackFieldConverterMock;

    protected function setUp()
    {
        parent::setUp();

        $this->slackActionConverterMock = \Mockery::mock(SlackActionConverter::class);
        $this->slackFieldConverterMock = \Mockery::mock(SlackFieldConverter::class);

        $this->slackAttachmentConverter = new SlackAttachmentConverter();
        $this->slackAttachmentConverter->setSlackActionConverter($this->slackActionConverterMock);
        $this->slackAttachmentConverter->setSlackFieldConverter($this->slackFieldConverterMock);
    }

    public function test_convert()
    {
        $slackField = new SlackField();
        $slackField->setTitle('title')
            ->setValue('value')
            ->setShort(true);

        $slackAction = new SlackAction();
        $slackAction->setStyle('primary')
            ->setType('button')
            ->setText('text')
            ->setUrl('https://unit-test.com')
            ->setName('name');

        $slackAttachment = new SlackAttachment();
        $slackAttachment
            ->setActions([$slackAction])
            ->setAuthorName('author-name')
            ->setAuthorLinkUrl('https://unit-test.com/author-link')
            ->setAuthorIconUrl('https://unit-test.com/author-icon')
            ->setColor('#333333')
            ->setFallbackText('fallback')
            ->setFields([$slackField])
            ->setFooterIconUrl('https://unit-test.com/footer-icon')
            ->setFooterText('footer')
            ->setImageUrl('https://unit-test.com/image')
            ->setPretext('pretext')
            ->setText('text')
            ->setThumbnailUrl('https://unit-test.com/thumbnail')
            ->setTitle('title')
            ->setTitleLinkUrl('https://unit-test.com/title-link');

        $this->slackActionConverterMock
            ->shouldReceive('convert')
            ->with($slackAction)
            ->andReturn([
                ['data']
            ]);

        $this->slackFieldConverterMock
            ->shouldReceive('convert')
            ->with($slackField)
            ->andReturn([
                ['data']
            ]);

        $data = $this->slackAttachmentConverter->convert($slackAttachment);

        $this->assertArrayHasKey('actions', $data);
        $this->assertArrayHasKey('author_icon', $data);
        $this->assertArrayHasKey('author_link', $data);
        $this->assertArrayHasKey('author_name', $data);
        $this->assertArrayHasKey('color', $data);
        $this->assertArrayHasKey('fallback', $data);
        $this->assertArrayHasKey('fields', $data);
        $this->assertArrayHasKey('footer_icon', $data);
        $this->assertArrayHasKey('footer', $data);
        $this->assertArrayHasKey('image_url', $data);
        $this->assertArrayHasKey('pretext', $data);
        $this->assertArrayHasKey('text', $data);
        $this->assertArrayHasKey('thumb_url', $data);
        $this->assertArrayHasKey('title', $data);
        $this->assertArrayHasKey('title_link', $data);

        $this->assertEquals($slackAttachment->getAuthorIconUrl(), $data['author_icon']);
        $this->assertEquals($slackAttachment->getAuthorLinkUrl(), $data['author_link']);
        $this->assertEquals($slackAttachment->getAuthorName(), $data['author_name']);
        $this->assertEquals($slackAttachment->getColor(), $data['color']);
        $this->assertEquals($slackAttachment->getFallbackText(), $data['fallback']);
        $this->assertEquals($slackAttachment->getFooterIconUrl(), $data['footer_icon']);
        $this->assertEquals($slackAttachment->getFooterText(), $data['footer']);
        $this->assertEquals($slackAttachment->getImageUrl(), $data['image_url']);
        $this->assertEquals($slackAttachment->getPretext(), $data['pretext']);
        $this->assertEquals($slackAttachment->getText(), $data['text']);
        $this->assertEquals($slackAttachment->getThumbnailUrl(), $data['thumb_url']);
        $this->assertEquals($slackAttachment->getTitle(), $data['title']);
        $this->assertEquals($slackAttachment->getTitleLinkUrl(), $data['title_link']);
    }

}