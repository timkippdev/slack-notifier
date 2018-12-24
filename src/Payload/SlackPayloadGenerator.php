<?php

namespace HidalgoRides\SlackNotifier\Payload;

use HidalgoRides\SlackNotifier\SlackAttachment;
use HidalgoRides\SlackNotifier\Payload\Converters\SlackAttachmentConverter;

class SlackPayloadGenerator {

    /** @var SlackAttachmentConverter */
    private $slackAttachmentConverter;

    public function __construct()
    {
        $this->slackAttachmentConverter = new SlackAttachmentConverter();
    }

    public function getSlackAttachmentConverter() : SlackAttachmentConverter
    {
        return $this->slackAttachmentConverter;
    }

    public function setSlackAttachmentConverter(SlackAttachmentConverter $slackAttachmentConverter)
    {
        $this->slackAttachmentConverter = $slackAttachmentConverter;
    }

    public function generate($message, array $attachments = []) : array
    {
        $payload = ['text' => $message];

        if (count($attachments) > 0)
        {
            $payload['attachments'] = [];

            foreach ($attachments as $attachment)
            {
                if ($attachment instanceof SlackAttachment)
                {
                    $attachmentData = $this->slackAttachmentConverter->convert($attachment);

                    if (count($attachmentData) > 0)
                    {
                        $payload['attachments'][] = $attachmentData;
                    }
                }
            }
        }

        return $payload;
    }

}