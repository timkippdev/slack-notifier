<?php

namespace HidalgoRides\SlackNotifier;

use HidalgoRides\SlackNotifier\SlackField;
use HidalgoRides\SlackNotifier\SlackAction;
use HidalgoRides\SlackNotifier\SlackAttachment;

class SlackPayloadGenerator {

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
                    $attachmentData = $this->generateAttachmentData($attachment);

                    if (count($attachmentData) > 0)
                    {
                        $payload['attachments'][] = $attachmentData;
                    }
                }
            }
        }

        return $payload;
    }

    private function generateAttachmentData(SlackAttachment $attachment) : array
    {
        $attachmentData = [];

        if (count($attachment->getActions()) > 0)
        {
            $actions = [];

            foreach ($attachment->getActions() as $action)
            {
                if ($action instanceof SlackAction)
                {
                    $actionData = [];

                    if (!is_null($action->getConfirmation()))
                    {
                        /** @var SlackActionConfirmation $confirmation */
                        $confirmation = $action->getConfirmation();
                        $confirmationData = [];

                        if (!is_null($confirmation->getDismissButtonText()))
                        {
                            $confirmationData['dismiss_text'] = $confirmation->getDismissButtonText();
                        }

                        if (!is_null($confirmation->getOkButtonText()))
                        {
                            $confirmationData['ok_text'] = $confirmation->getOkButtonText();
                        }

                        if (!is_null($confirmation->getText()))
                        {
                            $confirmationData['text'] = $confirmation->getText();
                        }

                        if (!is_null($confirmation->getTitle()))
                        {
                            $confirmationData['title'] = $confirmation->getTitle();
                        }

                        if (count($confirmationData) > 0)
                        {
                            $actionData['confirm'] = $confirmationData;
                        }
                    }

                    if (!is_null($action->getName()))
                    {
                        $actionData['name'] = $action->getName();
                    }

                    if (!is_null($action->getStyle()))
                    {
                        $actionData['style'] = $action->getStyle();
                    }

                    if (!is_null($action->getText()))
                    {
                        $actionData['text'] = $action->getText();
                    }

                    if (!is_null($action->getType()))
                    {
                        $actionData['type'] = $action->getType();
                    }

                    if (!is_null($action->getUrl()))
                    {
                        $actionData['url'] = $action->getUrl();
                    }

                    if (count($actionData) > 0)
                    {
                        $actions[] = $actionData;
                    }
                }
            }

            if (count($actions) > 0)
            {
                $attachmentData['actions'] = $actions;
            }
        }

        if (!is_null($attachment->getAuthorIconUrl()))
        {
            $attachmentData['author_icon'] = $attachment->getAuthorIconUrl();
        }

        if (!is_null($attachment->getAuthorLinkUrl()))
        {
            $attachmentData['author_link'] = $attachment->getAuthorLinkUrl();
        }

        if (!is_null($attachment->getAuthorName()))
        {
            $attachmentData['author_name'] = $attachment->getAuthorName();
        }

        if (!is_null($attachment->getColor()))
        {
            $attachmentData['color'] = $attachment->getColor();
        }

        if (!is_null($attachment->getFallbackText()))
        {
            $attachmentData['fallback'] = $attachment->getFallbackText();
        }

        if (count($attachment->getFields()) > 0)
        {
            $fields = [];

            foreach ($attachment->getFields() as $field)
            {
                if ($field instanceof SlackField)
                {
                    $fieldData = [];

                    if (!is_null($field->getTitle()))
                    {
                        $fieldData['title'] = $field->getTitle();
                    }

                    if (!is_null($field->getValue()))
                    {
                        $fieldData['value'] = $field->getValue();
                    }

                    if (!is_null($field->getShort()))
                    {
                        $fieldData['short'] = $field->getShort();
                    }

                    if (count($fieldData) > 0)
                    {
                        $fields[] = $fieldData;
                    }
                }
            }

            if (count($fields) > 0)
            {
                $attachmentData['fields'] = $fields;
            }
        }

        if (!is_null($attachment->getFooterIconUrl()))
        {
            $attachmentData['footer_icon'] = $attachment->getFooterIconUrl();
        }

        if (!is_null($attachment->getFooterText()))
        {
            $attachmentData['footer'] = $attachment->getFooterText();
        }

        if (!is_null($attachment->getImageUrl()))
        {
            $attachmentData['image_url'] = $attachment->getImageUrl();
        }

        if (!is_null($attachment->getPretext()))
        {
            $attachmentData['pretext'] = $attachment->getPretext();
        }

        if (!is_null($attachment->getText()))
        {
            $attachmentData['text'] = $attachment->getText();
        }

        if (!is_null($attachment->getThumbnailUrl()))
        {
            $attachmentData['thumb_url'] = $attachment->getThumbnailUrl();
        }

        if (!is_null($attachment->getTitle()))
        {
            $attachmentData['title'] = $attachment->getTitle();
        }

        if (!is_null($attachment->getTitleLinkUrl()))
        {
            $attachmentData['title_link'] = $attachment->getTitleLinkUrl();
        }

        return $attachmentData;
    }

}