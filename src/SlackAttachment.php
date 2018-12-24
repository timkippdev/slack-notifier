<?php

namespace HidalgoRides\SlackNotifier;

class SlackAttachment {

    private $actions = [];
    private $authorIconUrl;
    private $authorLinkUrl;
    private $authorName;
    private $color;
    private $fallbackText;
    private $fields = [];
    private $footerIconUrl;
    private $footerText;
    private $imageUrl;
    private $pretext;
    private $text;
    private $thumbnailUrl;
    private $title;
    private $titleLinkUrl;

    public function getActions() : array
    {
        return $this->actions;
    }

    public function setActions(array $actions) : SlackAttachment
    {
        $this->actions = $actions;
        return $this;
    }

    public function getAuthorIconUrl()
    {
        return $this->authorIconUrl;
    }

    public function setAuthorIconUrl($authorIconUrl) : SlackAttachment
    {
        $this->authorIconUrl = $authorIconUrl;
        return $this;
    }

    public function getAuthorLinkUrl()
    {
        return $this->authorLinkUrl;
    }

    public function setAuthorLinkUrl($authorLinkUrl) : SlackAttachment
    {
        $this->authorLinkUrl = $authorLinkUrl;
        return $this;
    }

    public function getAuthorName()
    {
        return $this->authorName;
    }

    public function setAuthorName($authorName) : SlackAttachment
    {
        $this->authorName = $authorName;
        return $this;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color) : SlackAttachment
    {
        $this->color = $color;
        return $this;
    }

    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    public function setImageUrl($imageUrl) : SlackAttachment
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function getFallbackText()
    {
        return $this->fallbackText;
    }

    public function setFallbackText($fallbackText) : SlackAttachment
    {
        $this->fallbackText = $fallbackText;
        return $this;
    }

    public function getFields() : array
    {
        return $this->fields;
    }

    public function setFields(array $fields) : SlackAttachment
    {
        $this->fields = $fields;
        return $this;
    }

    public function getFooterIconUrl()
    {
        return $this->footerIconUrl;
    }

    public function setFooterIconUrl($footerIconUrl) : SlackAttachment
    {
        $this->footerIconUrl = $footerIconUrl;
        return $this;
    }

    public function getFooterText()
    {
        return $this->footerText;
    }

    public function setFooterText($footerText) : SlackAttachment
    {
        $this->footerText = $footerText;
        return $this;
    }

    public function getPretext()
    {
        return $this->pretext;
    }

    public function setPretext($pretext) : SlackAttachment
    {
        $this->pretext = $pretext;
        return $this;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text) : SlackAttachment
    {
        $this->text = $text;
        return $this;
    }

    public function getThumbnailUrl()
    {
        return $this->thumbnailUrl;
    }

    public function setThumbnailUrl($thumbnailUrl) : SlackAttachment
    {
        $this->thumbnailUrl = $thumbnailUrl;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title) : SlackAttachment
    {
        $this->title = $title;
        return $this;
    }

    public function getTitleLinkUrl()
    {
        return $this->titleLinkUrl;
    }

    public function setTitleLinkUrl($titleLinkUrl) : SlackAttachment
    {
        $this->titleLinkUrl = $titleLinkUrl;
        return $this;
    }
    
}