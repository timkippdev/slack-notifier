# Slack Notifier

Slack Notifier utilitizes Slack's [Incoming Webhooks](https://slack.com/apps/A0F7XDUAZ-incoming-webhooks) feature to post messages directly to a Slack channel of your choosing through your individual Slack app Webhook URL.

## Installation

These instructions assume you already have Composer installed on your machine or the server you are working on.

Install through Composer:

```bash
composer require timkippdev/slack-notifier
```

## Usage

### Creating Slack App and Enabling Incoming Webhooks

See the following instructions provided by Slack to create your app, if needed, and obtain your Webhook URL: 

https://api.slack.com/incoming-webhooks#getting-started

### Setup `SlackNotifier` Instance

Once you have your Webhook URL, you can create a new instance of the `SlackNotifier` class:

```php
// your Webhook URL
$webhookAPI = 'https://hooks.slack.com/services/Txxxxxx/Byyyyyyy/Zzzzzzzzz';

// new SlackNotifier instance
$slackNotifier = new \TimKippDev\SlackNotifier\SlackNotifier($webhookAPI);
```

### Sending Messages

Now that you have your `SlackNotifier` instance created, you can use it to send a message with optional attachments to the channel configured from your Webhook URL.

#### Simple Message

```php
$slackNotifier->sendMessage('First message using Slack Notifier!');
```

#### Message with Attachments

For the complete Slack message attachment documentation, see the following link: https://api.slack.com/docs/message-attachments

```php
$slackAttachment = new \TimKippDev\SlackNotifier\SlackAttachment();
$slackAttachment
    ->setAuthorName('Author name goes here')
    ->setAuthorLinkUrl('https://example.com/author')
    ->setAuthorIconUrl('https://img.icons8.com/ultraviolet/48/000000/soy.png')
    ->setColor('#222222')
    ->setFallbackText('Fallback goes here')
    ->setFooterIconUrl('https://img.icons8.com/color/48/000000/soy.png')
    ->setFooterText('Footer text goes here')
    ->setImageUrl('https://img.icons8.com/color/400/000000/soy.png')
    ->setPretext('Pretext goes here')
    ->setText('Attached using Slack Notifier!')
    ->setThumbnailUrl('https://img.icons8.com/ultraviolet/96/000000/soy.png')
    ->setTitle('Title goes here')
    ->setTitleLinkUrl('https://example.com/title');

$slackNotifier->sendMessage('First message with attachments using Slack Notifier!', [
    $slackAttachment
]);
```

#### Attachment Actions

```php
$slackActionConfirmation = new \TimKippDev\SlackNotifier\SlackActionConfirmation();
$slackActionConfirmation->setDismissButtonText('Dismiss')
    ->setOkButtonText('Confirm')
    ->setText('Confirmation Text')
    ->setTitle('Confirmation Title');

$slackAction = new \TimKippDev\SlackNotifier\SlackAction();
$slackAction->setStyle('primary')
    ->setType('button')
    ->setText('Click Me with Confirmation')
    ->setUrl('https://example.com/action')
    ->setName('action-name')
    ->setConfirmation($slackActionConfirmation);

$slackAttachment = new \TimKippDev\SlackNotifier\SlackAttachment();
$slackAttachment
    ->setText('Attached using Slack Notifier!')
    ->setActions([$slackAction]);

$slackNotifier->sendMessage('First message attachment containing actions using Slack Notifier!', [
    $slackAttachment
]);
```

#### Attachment Fields

```php
$slackField = new \TimKippDev\SlackNotifier\SlackField();
$slackField->setTitle('Field Title')
    ->setValue('Field Value');

$slackAttachment = new \TimKippDev\SlackNotifier\SlackAttachment();
$slackAttachment
    ->setText('Attached using Slack Notifier!')
    ->setFields([$slackField]);

$slackNotifier->sendMessage('First message attachment containing fields using Slack Notifier!', [
    $slackAttachment
]);
```
