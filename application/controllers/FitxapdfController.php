<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FitxapdfController extends CI_Controller { 

   public function __construct () 
   { 
      parent::__construct ();

      // Helper to generate url for QR & url_title for PDF filename
      $this->load->helper('url');

      $this->load->library('Pdf');
      $this->load->model("pdfModel");
   } 
   /**
    * Generates PDFs for all centers with all families and cicles
    * @param [integer] [$codicentre=null] [Center standard code. If is null, functions generates pdf for all registered centers]
    */
   public function fitxacentre($codicentre=null) 
   { // 25002799 = caparrella
      if ($codicentre==null)
      {
         $centres=$this->pdfModel->getCentres();

         $pdf = new Pdf('P', 'mm', 'A4', true, 'Unicode ', false);		
         $pdf->SetCreator(PDF_CREATOR);
         $pdf->SetAuthor('by Capalabs. INS Caparrella.');
         $pdf->SetTitle("Fitxes centres");

         $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

         $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP+10, PDF_MARGIN_RIGHT);

         $pdf->startPageGroup();

         foreach($centres as $centre){
            $this->WriteFitxaForCentreObj($pdf,$centre);
         }

         $nombre_archivo = utf8_decode("fitxa-centres.pdf");
         $pdf->Output($nombre_archivo, 'I');

      } else {
         $centre=$this->pdfModel->getCentreByCode($codicentre);

         if ($centre==null) show_404();

         $pdf = new Pdf('P', 'mm', 'A4', true, 'Unicode ', false);		
         $pdf->SetCreator(PDF_CREATOR);
         $pdf->SetAuthor('by Capalabs. INS Caparrella.');
         $pdf->SetTitle("Fitxa ". trim($centre['name']));

         $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

         $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP+10, PDF_MARGIN_RIGHT);

         $pdf->startPageGroup();

         $this->WriteFitxaForCentreObj($pdf,$centre);

         $nombre_archivo = utf8_decode("fitxa-".url_title(trim($centre['name'])).".pdf");
         $pdf->Output($nombre_archivo, 'I');
      }
   }
   /**
    * [Generates a PDF with all cicles into a Family or generates a PDF with all families and all cicles]
    * @param [string] [$familia=null] [Code for family, if null it generates all families]
    */
   public function fitxa ($familia=null)
   {
      $pdf = new Pdf('P', 'mm', 'A4', true, 'Unicode ', false);		
      $pdf->SetCreator(PDF_CREATOR);
      $pdf->SetAuthor('by Capalabs. INS Caparrella.');

      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
      $pdf->SetFont('freemono', '', 11, '', true);

      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP+10, PDF_MARGIN_RIGHT);

      $pdf->startPageGroup();

      if ($familia!=null) {
         $pdf->SetTitle("Fitxa Familia " );
         $pdf->SetSubject("Fitxa familia ");

         $this->WriteTableForFamilyAndType ($pdf, "#FBB900", "#F9EFD1", "CFGS", $familia, "fpgs");

         $this->WriteTableForFamilyAndType ($pdf, "#E95822", "#E8CCC2", "CFGM", $familia, "fpgm");


         $nombre_archivo = utf8_decode("CentresFamila-". $familia .".pdf");
         $pdf->Output($nombre_archivo, 'I');
      } else {
         $pdf->SetTitle("Fitxes Families " );
         $pdf->SetSubject("Fitxes families ");

         $families=$this->pdfModel->getFamilies();

         foreach($families as $family)
         {
            $this->WriteTableForFamilyAndType ($pdf, "#FBB900", "#F9EFD1", "CFGS", $family['code'], "fpgs");
            $this->WriteTableForFamilyAndType ($pdf, "#E95822", "#E8CCC2", "CFGM", $family['code'], "fpgm");
         }


         $nombre_archivo = utf8_decode("CentresFamiles.pdf");
         $pdf->Output($nombre_archivo, 'I');
      }
   }

   /***************** PRIVATE MEMBERS ******************************************/
   
   
   
   /**
    * Function that generates page for a Center
    * @param [object] $pdf    [PDF Object, to add pages]
    * @param [object] $centre [Center object with all basic information]
    */
   private function WriteFitxaForCentreObj ($pdf,$centre)
   {
      $codicentre=$centre['codicentre'];
      $pdf->AddPage();

      $pdf->SetFont('freemono', 'BU', 24); // Bold & Undeline / Size=24   
      $pdf->Cell(0, 10, trim($centre['name']), 0, false, 'C', 0, '', 0, false, 'T', 'M'); 

      $pdf->SetFont('freemono', '', 11, '', true);

      $estudis=$this->pdfModel->getEstudisByCentre($codicentre);
      $lastFamily='';

      $html ='
         <style>
            .headFamilia {
               background-color: #A6A6A6;
               color: #FFFFFF;
               font-size: 18px;
               font-weight: bold;
            }
            .fpgs{
               line-height: 18px;
               background-color: #F9EFD1; /*#FBB900;*/
               font-size: 12px;
            }
            .fpgm {
               line-height: 18px;
               background-color: #E8CCC2; /*#E95822;*/
               font-size: 11px;
            }
         </style>
         <table>
         ';

      $anotacions=[];
      $iNotes=0;
      foreach($estudis as $estudi)
      {
         if ($lastFamily!=$estudi['familia']) { 
            $html.='<tr class="headFamilia"><td>Familia '. $estudi['fname'] .'</td></tr>';
            $lastFamily=$estudi['familia'];
         }

         $html.= '<tr class="'.$estudi['type'].'"><td>';

         if ($estudi['type']=='fpgm') $html.= '&nbsp;&nbsp;- CFGM ';
         else $html.= '&nbsp;&nbsp;- CFGS ';

         $html.=$estudi['name'];     

         if ($estudi['dual']!=null || $estudi['observation']!=null) {

            $anotacions[$iNotes]='';
            if ($estudi['dual']!=null) $anotacions[$iNotes].="Dual. ";
            if ($estudi['observation']!=null) $anotacions[$iNotes].=$estudi['observation'];

            $iNotes++;
            $html.=' <strong>['.$iNotes.']</strong>';
         }

         $html.='</td></tr>';     
      }

      if ($iNotes>0) {
         $html.='<tr><td>&nbsp;</td></tr>';
         for ($iNota=0;$iNota<$iNotes;$iNota++) {
            $html.='<tr><td>';
            $html.='<strong>['. ($iNota+1) . '] </strong>';
            $html.=$anotacions[$iNota];
            $html.='</td></tr>';
         }
      }

      $html.="</table>";

      $pdf->writeHTMLCell($w = '', $h = 0, $x = 20, $y = 50, $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);  

      $pdf->urlpdf=base_url('/fitxa/'.$codicentre ); // set footer url

      list($r, $g, $b) = sscanf("#E95822", "#%02x%02x%02x");

      $style = array(
         'border' => 1,
         'padding' => 2,
         'fgcolor' => array($r,$g,$b),
         'bgcolor' => false
      );

      // QRCODE,H : QR-CODE Best error correction
      $pdf->write2DBarcode($pdf->urlpdf, 'QRCODE,H', 160, 245, 27, 27, $style, 'N');

      $pdf->SetFont('helvetica', 'B', 20);
      $pdf->Text(137, 245, "Fitxa");
      $pdf->Text(137, 251, "digital");

      $pdf->SetFont('freemono', '', 11, '', true);
   }

   /**
    * Writes table for a Studies Family and Type of Studies
    * @param [object] $pdf          [PDF Object to add pages]
    * @param [string] $headColor    [Hex color for table header]
    * @param [string] $bodyColor    [Hex color for table content]
    * @param [string] $titleStudies [Title to show in table, possible values are: CFGS or CFGM]
    * @param [string] $familia      [Study family code, this code select info from DB]
    * @param [string] $studiesType  [Type of studies, possible values are: fpgs or fpgm]
    */
   private function WriteTableForFamilyAndType ($pdf, $headColor, $bodyColor, $titleStudies, $familia, $studiesType)
   {
      $dbFamily = $this->pdfModel->getFamily($familia);

      if ($dbFamily==null) //IF Family not found, ERROR 404-Page not found
         show_404();

      $html ='
         <style>
            .headFamilia {
               background-color: ' . $headColor . ' ; ///#FBB900 *Color CFGS*/
               font-size: 20px;
            }
            .headCicle{
               line-height: 25px;
               font-weight: bold;
               font-size: 11px;
               background-color: '. $bodyColor .'; /*Color F9EFD1 CFGS rebaixat*/
            }
            .bodyCentres {
               background-color: '. $bodyColor .'; /*Color F9EFD1 CFGS rebaixat*/
            }

         </style>

         <div class="headFamilia">'. $titleStudies .' Familia '. $dbFamily['name'] .'</div>
         <table>
         ';

      $estudis= $this->pdfModel->getStudiesByFamily($familia,$studiesType);

      $anotacions=[];
      $iNotes=0;

      foreach($estudis as $cicle){

         $centres_cicle=$this->pdfModel->getCentresByEstudi($cicle['id']);

         if (count($centres_cicle)>0) 
            $html.='<tr class="headCicle"><td>'. $titleStudies.' '. $cicle['name'] . '</td></tr>';

         foreach($centres_cicle as $centre){

            $html.='<tr><td class="bodyCentres">&nbsp;&nbsp;&nbsp;- '. $centre['name'] . ' ('. $centre['location'].') ';

            if ($centre['dual']!=null || $centre['observation']!=null) {

               $anotacions[$iNotes]='';
               if ($centre['dual']!=null) $anotacions[$iNotes].="Dual. ";
               if ($centre['observation']!=null) $anotacions[$iNotes].=$centre['observation'];

               $iNotes++;
               $html.='<strong>['.$iNotes.']</strong>';
            }

            if (count($centres_cicle)>0) 
               $html.='</td></tr>';
         }
      }
      $html.='<tr><td class="bodyCentres">&nbsp;</td></tr>';

      if ($iNotes>0) {
         $html.='<tr><td>&nbsp;</td></tr>';
         for ($iNota=0;$iNota<$iNotes;$iNota++) {
            $html.='<tr><td>';
            $html.='<strong>['. ($iNota+1) . '] </strong>';
            $html.=$anotacions[$iNota];
            $html.='</td></tr>';
         }
      }

      $html.="</table>";

      if (count($estudis)>0) {
         $pdf->AddPage();
         $pdf->writeHTMLCell($w = '', $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);  

         $pdf->urlpdf=base_url('/fitxa/'.$familia ); // set footer url

         list($r, $g, $b) = sscanf($headColor, "#%02x%02x%02x");

         $style = array(
            'border' => 1,
            'padding' => 2,
            'fgcolor' => array($r,$g,$b),
            'bgcolor' => false
         );

         // QRCODE,H : QR-CODE Best error correction
         $pdf->write2DBarcode($pdf->urlpdf, 'QRCODE,H', 90, 230, 40, 40, $style, 'N');

         $pdf->SetFont('helvetica', 'B', 20);
         $pdf->Text(92, 220, "Scan me");

         $pdf->SetFont('freemono', '', 11, '', true);
      }
   }
}