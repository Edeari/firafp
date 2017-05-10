<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

date_default_timezone_set('Europe/Madrid');


class Pdf extends TCPDF
{
   public $urlpdf;

   function __construct()
   {
      parent::__construct();
   }

   public function Header() {

      $image_file = K_PATH_IMAGES.'gencat.png';
      $this->Image($image_file, 10, 10, 17, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

      $address = '<p>Generalitat de Catalunya<br />
					<strong>Departament d&#39;Ensenyament</strong><br/>
                    <span style="font-size:9px">Serveis Territorials Lleida<br/>
                    Coordinació FP</span>';

      $this->writeHTMLCell($w = 0, $h = 0, $x = 29, $y = 10, $address, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

      $logos = "<style type='text/css'>span {font-size:8px;}</style>
					<p>by Capalabs<br />
					<strong>INS Caparrella</strong><br />
					</p>";
      $this->writeHTMLCell($w = 100, $h = 0, $x = '160', $y = '15', $logos, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'L', $autopadding = true);     
   }

   // Page footer
   public function Footer() {
      // Position at 15 mm from bottom
      $this->SetY(-15);
      $this->SetFont('helvetica', 'I', 10);
      
      // [Generation date]		[url]		[Page number]
      //Cell ($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')

      $this->Cell(15, 10, date("d/m/Y H:i"), 0, false, 'L', 0, '', 0, false, 'T', 'M');

      $this->Cell(0, 10, $this->urlpdf, 0, false, 'C', 0, '', 0, false, 'T', 'M'); 

      if (empty($this->pagegroups))
         $this->Cell(0, 10, 'Pàgina '.$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
      else
         $this->Cell(0, 10, 'Pàgina '.$this->getGroupPageNo().' de '.$this->getPageGroupAlias(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
   }

}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */