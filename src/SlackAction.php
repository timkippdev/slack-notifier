<?php

namespace HidalgoRides\SlackNotifier;

use HidalgoRides\SlackNotifier\SlackActionConfirmation;

class SlackAction {

    /** @var SlackActionConfirmation */
    private $confirmation;
    private $name;
    private $style;
    private $text;
    private $type;
    private $url;

    public function getConfirmation()
    {
        return $this->confirmation;
    }

    public function setConfirmation(SlackActionConfirmation $slackActionConfirmation) : SlackAction
    {
        $this->confirmation = $slackActionConfirmation;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name) : SlackAction
    {
        $this->name = $name;
        return $this;
    }

    public function getStyle()
    {
        return $this->style;
    }

    public function setStyle($style) : SlackAction
    {
        $this->style = $style;
        return $this;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text) : SlackAction
    {
        $this->text = $text;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type) : SlackAction
    {
        $this->type = $type;
        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url) : SlackAction
    {
        $this->url = $url;
        return $this;
    }

}