<?php

namespace TimKippDev\SlackNotifier\Payload\Converters;

use TimKippDev\SlackNotifier\SlackField;
use TimKippDev\SlackNotifier\SlackAction;
use TimKippDev\SlackNotifier\SlackAttachment;
use TimKippDev\SlackNotifier\Payload\Converters\SlackFieldConverter;
use TimKippDev\SlackNotifier\Payload\Converters\SlackActionConverter;

class SlackAttachmentConverter {

    /** @var SlackActionConverter */
    private $slackActionConverter;

    /** @var SlackFieldConverter */
    private $slackFieldConverter;

    public function __construct()
    {
        $this->slackActionConverter = new SlackActionConverter();
        $this->slackFieldConverter = new SlackFieldConverter();
    }

    public function getSlackActionConverter() : SlackActionConverter
    {
        return $this->slackActionConverter;
    }

    public function setSlackActionConverter(SlackActionConverter $slackActionConverter)
    {
        $this->slackActionConverter = $slackActionConverter;
    }

    public function getSlackFieldConverter() : SlackFieldConverter
    {
        return $this->slackFieldConverter;
    }

    public function setSlackFieldConverter(SlackFieldConverter $slackFieldConverter)
    {
        $this->slackFieldConverter = $slackFieldConverter;
    }

    public function convert(SlackAttachment $slackAttachment) : array
    {
        $data = [];

        if (count($slackAttachment->getActions()) > 0)
        {
            $attachmentActions = [];
        
            foreach ($slackAttachment->getActions() as $slackAction)
            {
                if ($slackAction instanceof SlackAction)
                {
                    $attachmentActionData = $this->slackActionConverter->convert($slackAction);
    
                    if (count($attachmentActionData) > 0)
                    {
                        $attachmentActions[] = $attachmentActionData;
                    }
                }
            }

            if (count($attachmentActions) > 0)
            {
                $data['actions'] = $attachmentActions;
            }
        }

        if (!is_null($slackAttachment->getAuthorIconUrl()))
        {
            $data['author_icon'] = $slackAttachment->getAuthorIconUrl();
        }

        if (!is_null($slackAttachment->getAuthorLinkUrl()))
        {
            $data['author_link'] = $slackAttachment->getAuthorLinkUrl();
        }

        if (!is_null($slackAttachment->getAuthorName()))
        {
            $data['author_name'] = $slackAttachment->getAuthorName();
        }

        if (!is_null($slackAttachment->getColor()))
        {
            $data['color'] = $slackAttachment->getColor();
        }

        if (!is_null($slackAttachment->getFallbackText()))
        {
            $data['fallback'] = $slackAttachment->getFallbackText();
        }

        if (count($slackAttachment->getFields()) > 0)
        {
            $fields = [];

            foreach ($slackAttachment->getFields() as $slackField)
            {
                if ($slackField instanceof SlackField)
                {
                    $attachmentFieldData = $this->slackFieldConverter->convert($slackField);

                    if (count($attachmentFieldData) > 0)
                    {
                        $fields[] = $attachmentFieldData;
                    }
                }
            }

            if (count($fields) > 0)
            {
                $data['fields'] = $fields;
            }
        }

        if (!is_null($slackAttachment->getFooterIconUrl()))
        {
            $data['footer_icon'] = $slackAttachment->getFooterIconUrl();
        }

        if (!is_null($slackAttachment->getFooterText()))
        {
            $data['footer'] = $slackAttachment->getFooterText();
        }

        if (!is_null($slackAttachment->getImageUrl()))
        {
            $data['image_url'] = $slackAttachment->getImageUrl();
        }

        if (!is_null($slackAttachment->getPretext()))
        {
            $data['pretext'] = $slackAttachment->getPretext();
        }

        if (!is_null($slackAttachment->getText()))
        {
            $data['text'] = $slackAttachment->getText();
        }

        if (!is_null($slackAttachment->getThumbnailUrl()))
        {
            $data['thumb_url'] = $slackAttachment->getThumbnailUrl();
        }

        if (!is_null($slackAttachment->getTitle()))
        {
            $data['title'] = $slackAttachment->getTitle();
        }

        if (!is_null($slackAttachment->getTitleLinkUrl()))
        {
            $data['title_link'] = $slackAttachment->getTitleLinkUrl();
        }

        return $data;
    }

}