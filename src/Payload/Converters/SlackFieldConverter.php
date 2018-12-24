<?php

namespace HidalgoRides\SlackNotifier\Payload\Converters;

use HidalgoRides\SlackNotifier\SlackField;

class SlackFieldConverter {

    public function convert(SlackField $slackField) : array
    {
        $data = [];

        if (!is_null($slackField->getTitle()))
        {
            $data['title'] = $slackField->getTitle();
        }

        if (!is_null($slackField->getValue()))
        {
            $data['value'] = $slackField->getValue();
        }

        if (!is_null($slackField->getShort()))
        {
            $data['short'] = $slackField->getShort();
        }

        return $data;
    }

}