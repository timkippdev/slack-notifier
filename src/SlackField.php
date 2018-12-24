<?php

namespace HidalgoRides\SlackNotifier;

class SlackField {

    private $short;
    private $title;
    private $value;

    public function getShort()
    {
        return $this->short;
    }

    public function setShort(bool $short) : SlackField 
    {
        $this->short = $short;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title) : SlackField
    {
        $this->title = $title;
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value) : SlackField
    {
        $this->value = $value;
        return $this;
    }

}