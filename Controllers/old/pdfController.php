<?php
/**
 * Created by PhpStorm.
 * User: JCPONCE
 * Date: 30/03/2017
 * Time: 06:08 PM
 */
class pdfController extends Controller
{
    private $_pdf;
    public function __construct()
    {

        parent::__construct();
        $this->_pdf=$this->getLibrary('fpdf');
        $this->_pdf=new FPDF;
    }

    public function index()
    {

    }

    public function pdf1($nombre,$apellido)
    {
        $this->_pdf->AddPage();
        $this->_pdf->SetFont('Arial','B',16);
        $this->_pdf->Cell(40,10,utf8_decode($nombre.' '.$apellido));
        $this->_pdf->Output();
    }
}