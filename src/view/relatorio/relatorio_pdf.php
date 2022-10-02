<?php


define('FPDF_FONTPATH', 'font/');
require('../../model/fpdf/fpdf.php');

class myRelatorio extends FPDF{
    function header(){
       $this->Image('../asset/img/Logo-Ham-PNG-200x77.png',10,6);
       $this->SetFont('Arial', 'B', 14);
       $this->Cell(276, 5,'Relatorio Contratos', 0,0,'C');
       $this->Ln();
       $this->SetFont('Times','',12);
       $this->Cell(276,10,'Relatorio',0,0,'C');
       $this->Ln(20);

    }

    function footer(){
      $this->SetY(-15);
      $this->SetFont('Arial','', 0);
      $this->Cell(0,10,'Pagina'.$this->PageNo().'/{nb}',0,0,'C');
    }

    function viewTable(){
       $this->SetFont('Times','B', 12);
       $this->Cell(70,10,'Empresa',1,0,'L');
       $this->Cell(20,10,utf8_decode('Número'),1,0,'L');
       $this->Cell(20,10,utf8_decode('Vigência'),1,0,'L');
       $this->Cell(20,10,'Inicio',1,0,'L');
       $this->Cell(20,10,'Fim',1,0,'L');
       $this->Cell(60,10,'Valor Contrato',1,0,'L');
       $this->Cell(30,10,'Nota Fiscal',1,0,'L');
       $this->Cell(25,10,utf8_decode('Situação'),1,0,'L');
       $this->Ln();
    }

    function resultView(){
        $this->SetFont('Times','B', 9);
        include_once("../../model/conection/conexao.php");
        $tipo = $_GET['tipo'];
        if($tipo != ""){
            $select_contratos = mysqli_query($conectar,"SELECT * FROM contratos WHERE tipo_contrato = '$tipo'");
            while($puxar = mysqli_fetch_assoc($select_contratos)){
                extract($puxar);
                $select_fornecedor = mysqli_query($conectar, "SELECT nome_fornecedor FROM fornecedor WHERE id_fornecedor = '$fk_fornecedor'");
                $assoc_fornecedor = mysqli_fetch_assoc($select_fornecedor);
                $this->Cell(70,10,$assoc_fornecedor['nome_fornecedor'],1,0,'L');
                $this->Cell(20,10,$numero_contrato,1,0,'L');
                $this->Cell(20,10,$vigencia,1,0,'L');
                $this->Cell(20,10,date('d/m/Y', strtotime($data_inicio_contrato)) ,1,0,'L');
                $this->Cell(20,10,date('d/m/Y', strtotime($data_fim_contrato)) ,1,0,'L');
                $this->Cell(60,10,"R$ $valor_contrato",1,0,'L');
                $this->Cell(30,10,$nota_fiscal,1,0,'L');
                $this->Cell(25,10,$situacao,1,0,'L');
                $this->Ln();
        }

        }else{
            $select_contratos = mysqli_query($conectar,"SELECT * FROM contratos");
            while($puxar = mysqli_fetch_assoc($select_contratos)){
                extract($puxar);
                $select_fornecedor = mysqli_query($conectar, "SELECT nome_fornecedor FROM fornecedor WHERE id_fornecedor = '$fk_fornecedor'");
                $assoc_fornecedor = mysqli_fetch_assoc($select_fornecedor);
                $this->Cell(70,10,$assoc_fornecedor['nome_fornecedor'],1,0,'L');
                $this->Cell(20,10,$numero_contrato,1,0,'L');
                $this->Cell(20,10,$vigencia,1,0,'L');
                $this->Cell(20,10,date('d/m/Y', strtotime($data_inicio_contrato)) ,1,0,'L');
                $this->Cell(20,10,date('d/m/Y', strtotime($data_fim_contrato)) ,1,0,'L');
                $this->Cell(60,10,"R$ $valor_contrato",1,0,'L');
                $this->Cell(30,10,$nota_fiscal,1,0,'L');
                $this->Cell(25,10,$situacao,1,0,'L');
                $this->Ln();
        }
    }

}
}
;


$pdf = new myRelatorio();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);
$pdf->viewTable();
$pdf->resultView();
$pdf->Output();