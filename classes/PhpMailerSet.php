<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__.'/../classes/Imailer.php';
class PhpMailerSet implements Imailer
{
    private PHPMailer $mail;


    public function sendMail($to, $subject, $body, $attachement)
    {
        try {
            $phpmailer = new PHPMailer(true);
            $phpmailer->CharSet = 'UTF-8';
            $phpmailer->Encoding = 'base64';
            $phpmailer->SMTPDebug = SMTP::DEBUG_OFF;
            $phpmailer->isSMTP();
            $phpmailer->Host = 'smtp.gmail.com';
            $phpmailer->Username =  'ael46041@gmail.com';
            $phpmailer->Password = 'gksiliyxrshxaelr';
            $phpmailer->SMTPAuth = true;
            $phpmailer->SMTPSecure = 'ssl';
            $phpmailer->Port = 465;
            $phpmailer->isHTML(true);
            $phpmailer->setFrom('ael46041@gmail.com', 'Brief Sport');
            $phpmailer->addAddress($to);
            $phpmailer->Subject = $subject;
            $phpmailer->Body = $body;
            $phpmailer->AltBody = $body;
            $phpmailer->addAttachment($attachement);
            $phpmailer->send();
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}