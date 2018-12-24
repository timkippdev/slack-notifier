<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use HidalgoRides\SlackNotifier\SlackField;
use HidalgoRides\SlackNotifier\SlackAction;
use HidalgoRides\SlackNotifier\SlackAttachment;
use HidalgoRides\SlackNotifier\SlackPayloadGenerator;
use HidalgoRides\SlackNotifier\SlackActionConfirmation;

class SlackPayloadGeneratorTest extends TestCase {

    /** @var SlackPayloadGenerator */
    private $generator;

    protected function setUp()
    {
        parent::setUp();

        $this->generator = new SlackPayloadGenerator();
    }

    public function test_verifyPayloadFields_noAttachments()
    {
        $payload = $this->generator->generate('message');

        $this->assertNotNull($payload);
        $this->assertArrayHasKey('text', $payload);
        $this->assertEquals('message', $payload['text']);
    }

    public function test_verifyPayloadFields_withAttachments()
    {
        $slackField = new SlackField();
        $slackField->setTitle('title')
            ->setValue('value')
            ->setShort(true);

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

        $payload = $this->generator->generate('message', [
            $slackAttachment
        ]);

        $this->assertNotNull($payload);
        $this->assertArrayHasKey('text', $payload);
        $this->assertArrayHasKey('attachments', $payload);
        
        $attachments = $payload['attachments'];
        $this->assertIsArray($attachments);
        $this->assertCount(1, $attachments);

        $attachment = $attachments[0];

        $this->assertArrayHasKey('actions', $attachment);
        $this->assertArrayHasKey('author_icon', $attachment);
        $this->assertArrayHasKey('author_link', $attachment);
        $this->assertArrayHasKey('author_name', $attachment);
        $this->assertArrayHasKey('color', $attachment);
        $this->assertArrayHasKey('fallback', $attachment);
        $this->assertArrayHasKey('fields', $attachment);
        $this->assertArrayHasKey('footer_icon', $attachment);
        $this->assertArrayHasKey('footer', $attachment);
        $this->assertArrayHasKey('image_url', $attachment);
        $this->assertArrayHasKey('pretext', $attachment);
        $this->assertArrayHasKey('text', $attachment);
        $this->assertArrayHasKey('thumb_url', $attachment);
        $this->assertArrayHasKey('title', $attachment);
        $this->assertArrayHasKey('title_link', $attachment);

        $this->assertEquals($slackAttachment->getAuthorIconUrl(), $attachment['author_icon']);
        $this->assertEquals($slackAttachment->getAuthorLinkUrl(), $attachment['author_link']);
        $this->assertEquals($slackAttachment->getAuthorName(), $attachment['author_name']);
        $this->assertEquals($slackAttachment->getColor(), $attachment['color']);
        $this->assertEquals($slackAttachment->getFallbackText(), $attachment['fallback']);
        $this->assertEquals($slackAttachment->getFooterIconUrl(), $attachment['footer_icon']);
        $this->assertEquals($slackAttachment->getFooterText(), $attachment['footer']);
        $this->assertEquals($slackAttachment->getImageUrl(), $attachment['image_url']);
        $this->assertEquals($slackAttachment->getPretext(), $attachment['pretext']);
        $this->assertEquals($slackAttachment->getText(), $attachment['text']);
        $this->assertEquals($slackAttachment->getThumbnailUrl(), $attachment['thumb_url']);
        $this->assertEquals($slackAttachment->getTitle(), $attachment['title']);
        $this->assertEquals($slackAttachment->getTitleLinkUrl(), $attachment['title_link']);

        $actions = $attachment['actions'];
        $this->assertIsArray($actions);
        $this->assertCount(1, $actions);

        $action = $actions[0];
        $this->assertArrayHasKey('confirm', $action);
        $this->assertArrayHasKey('name', $action);
        $this->assertArrayHasKey('style', $action);
        $this->assertArrayHasKey('text', $action);
        $this->assertArrayHasKey('type', $action);
        $this->assertArrayHasKey('url', $action);

        $this->assertEquals($slackAction->getName(), $action['name']);
        $this->assertEquals($slackAction->getStyle(), $action['style']);
        $this->assertEquals($slackAction->getText(), $action['text']);
        $this->assertEquals($slackAction->getType(), $action['type']);
        $this->assertEquals($slackAction->getUrl(), $action['url']);

        $actionConfirmation = $action['confirm'];
        $this->assertIsArray($actionConfirmation);
        $this->assertArrayHasKey('dismiss_text', $actionConfirmation);
        $this->assertArrayHasKey('ok_text', $actionConfirmation);
        $this->assertArrayHasKey('text', $actionConfirmation);
        $this->assertArrayHasKey('title', $actionConfirmation);

        $this->assertEquals($slackActionConfirmation->getDismissButtonText(), $actionConfirmation['dismiss_text']);
        $this->assertEquals($slackActionConfirmation->getOkButtonText(), $actionConfirmation['ok_text']);
        $this->assertEquals($slackActionConfirmation->getText(), $actionConfirmation['text']);
        $this->assertEquals($slackActionConfirmation->getTitle(), $actionConfirmation['title']);

        $fields = $attachment['fields'];
        $this->assertIsArray($fields);
        $this->assertCount(1, $fields);

        $field = $fields[0];
        $this->assertArrayHasKey('title', $field);
        $this->assertArrayHasKey('value', $field);
        $this->assertArrayHasKey('short', $field);
        
        $this->assertEquals($slackField->getTitle(), $field['title']);
        $this->assertEquals($slackField->getValue(), $field['value']);
        $this->assertEquals($slackField->getShort(), $field['short']);
    }

}