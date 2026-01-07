<?php

interface Imailer
{
    public function sendMail($to, $subject, $body, $attachement);
}