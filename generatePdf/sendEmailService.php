<?php


class SendEmailService
{
    private $mailer;
    private $pdfGenerator;

    function __CONSTRUCT(Imailer $mailer, GeneratePdf $pdfGenerator)
    {
        $this->mailer = $mailer;
        $this->pdfGenerator = $pdfGenerator;

    }


    function sendTicket( $ticket_id,$to,$subject,$body)
    {
        $path=$this->pdfGenerator->savePdf($ticket_id);
        $this->mailer->sendMail($to,$subject,$body,$path);


    }


}