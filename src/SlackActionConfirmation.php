<?php

namespace HidalgoRides\SlackNotifier;

class SlackActionConfirmation {

    private $dismissButtonText;
    private $okButtonText;
    private $text;
    private $title;

    public function getDismissButtonText()
    {
        return $this->dismissButtonText;
    }

    public function setDismissButtonText($dismissButtonText) : SlackActionConfirmation
    {
        $this->dismissButtonText = $dismissButtonText;
        return $this;
    }

    public function getOkButtonText()
    {
        return $this->okButtonText;
    }

    public function setOkButtonText($okButtonText) : SlackActionConfirmation
    {
        $this->okButtonText = $okButtonText;
        return $this;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text) : SlackActionConfirmation
    {
        $this->text = $text;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title) : SlackActionConfirmation
    {
        $this->title = $title;
        return $this;
    }

}