<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
require_once __DIR__."/vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;
class GeneratePdf{
    private Options $options;
    private Dompdf $dompdf;
    public function __construct(Options $options){
        $this->options = $options;
    }
    public  function downloadPdf($ticket_id)
    {
        $root = realpath(__DIR__."/../");
        try{
            $ticket_id = $ticket_id ?? null;
            $this->options->setIsRemoteEnabled(true);
            $this->options->setChroot($root);
            $this->dompdf= new Dompdf($this->options);
            ob_start();
            require_once __DIR__."/pdfTemplate.php";
            $ticketHtml= ob_get_clean();
            $this->dompdf->loadHtml($ticketHtml);
            $this->dompdf->render();
            $this->dompdf->stream("ticket.pdf", array("Attachment" => false));
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }


    public function savePdf($ticket_id)
    {
        $root = realpath(__DIR__."/../");
        try{
            $ticket_id = $ticket_id ?? null;
            $this->options->setIsRemoteEnabled(true);
            $root = realpath(__DIR__."/../");
            $this->options->setChroot($root);
            $this->dompdf= new Dompdf($this->options);
            ob_start();
            require_once __DIR__."/pdfTemplate.php";
            $ticketHtml= ob_get_clean();
            $this->dompdf->loadHtml($ticketHtml);
            $this->dompdf->render();
            $pathPdf = $root."/tickets/ticket-".$ticket_id.".pdf";
            file_put_contents($pathPdf, $this->dompdf->output());
            return $pathPdf;
        }catch (Exception $e){
            echo $e->getMessage();
        }

    }


}

