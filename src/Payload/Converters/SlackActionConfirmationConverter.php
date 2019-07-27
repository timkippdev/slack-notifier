<?php

namespace TimKippDev\SlackNotifier\Payload\Converters;

use TimKippDev\SlackNotifier\SlackActionConfirmation;

class SlackActionConfirmationConverter {

    public function convert(SlackActionConfirmation $slackActionConfirmation) : array
    {
        $data = [];

        if (!is_null($slackActionConfirmation->getDismissButtonText()))
        {
            $data['dismiss_text'] = $slackActionConfirmation->getDismissButtonText();
        }

        if (!is_null($slackActionConfirmation->getOkButtonText()))
        {
            $data['ok_text'] = $slackActionConfirmation->getOkButtonText();
        }

        if (!is_null($slackActionConfirmation->getText()))
        {
            $data['text'] = $slackActionConfirmation->getText();
        }

        if (!is_null($slackActionConfirmation->getTitle()))
        {
            $data['title'] = $slackActionConfirmation->getTitle();
        }

        return $data;
    }

}