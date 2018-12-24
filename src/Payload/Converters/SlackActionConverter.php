<?php

namespace HidalgoRides\SlackNotifier\Payload\Converters;

use HidalgoRides\SlackNotifier\SlackAction;
use HidalgoRides\SlackNotifier\Payload\Converters\SlackActionConfirmationConverter;

class SlackActionConverter {

    /** @var SlackActionConfirmationConverter */
    private $slackActionConfirmationConverter;

    public function __construct()
    {
        $this->slackActionConfirmationConverter = new SlackActionConfirmationConverter();
    }

    public function getSlackActionConfirmationConverter() : SlackActionConfirmationConverter
    {
        return $this->slackActionConfirmationConverter;
    }

    public function setSlackActionConfirmationConverter(SlackActionConfirmationConverter $slackActionConfirmationConverter)
    {
        $this->slackActionConfirmationConverter = $slackActionConfirmationConverter;
    }

    public function convert(SlackAction $slackAction) : array
    {
        $data = [];

        if (!is_null($slackAction->getConfirmation()))
        {
            $attachmentActionConfimationData = $this->slackActionConfirmationConverter->convert($slackAction->getConfirmation());

            if (count($attachmentActionConfimationData) > 0)
            {
                $data['confirm'] = $attachmentActionConfimationData;
            }
        }

        if (!is_null($slackAction->getName()))
        {
            $data['name'] = $slackAction->getName();
        }

        if (!is_null($slackAction->getStyle()))
        {
            $data['style'] = $slackAction->getStyle();
        }

        if (!is_null($slackAction->getText()))
        {
            $data['text'] = $slackAction->getText();
        }

        if (!is_null($slackAction->getType()))
        {
            $data['type'] = $slackAction->getType();
        }

        if (!is_null($slackAction->getUrl()))
        {
            $data['url'] = $slackAction->getUrl();
        }

        return $data;
    }

}