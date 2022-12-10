<?php
    require('FPDF/fpdf.php');

    class PDF extends FPDF
    {
    // Cabecera de página
    function Header()
    {
        // Logo
        
        // Arial bold 15
        $this->SetFont('Arial','B',20);
        // Movernos a la derecha
        $this->Cell(1,0);
        //color

        
        $this->SetTextColor(255,255,255);
        $this->SetFillColor(28,158,68);
        // Título
        $this->Cell(20,20,'',0,0,'C',true);
        $this->Cell(235,20,'Reporte de los Alimentos',0,0,'C',true);

        $this->SetFont('Arial','B',10);
        $this->Cell(20,20,date("d")."-".date("m")."-".date("Y"),0,0,'C',true);
        $this->Image('logo2.jpeg',10,10,22);
        // Salto de línea
        $this->Ln(25);


        $this->SetTextColor(255,255,255);
        $this->SetFillColor(28,158,68);
        

        $this->SetFont('Arial','',7);

        $this->Cell(10, 10, 'ID',1,0,'C',true);
        $this->Cell(30, 10, 'ALIMENTO',1,0,'C',true);
        $this->Cell(20, 10, 'EMPAQUE',1,0,'C',true);
        $this->Cell(25, 10, 'CLASIFICAION',1,0,'C',true);
        $this->Cell(15, 10, 'STOCK',1,0,'C',true);
        $this->Cell(20, 10, 'STOCK MIN.',1,0,'C',true);
        $this->Cell(20, 10, 'STOCK MAX.',1,0,'C',true);
        $this->Cell(30, 10, 'CONSUMO MENSUAL',1,0,'C',true);
        $this->Cell(25, 10, 'PEDIDO $$',1,0,'C',true);
        $this->Cell(30, 10, 'MANTENIMIENTO $$',1,0,'C',true);
        $this->Cell(30, 10, 'ENTREGA EN DIAS',1,0,'C',true);
        $this->Cell(20, 10, 'VENCIMINETO',1,1,'C',true);
        
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página

        $this->Cell(0,10,utf8_decode('Pagina ').$this->PageNo().'/{nb}',0,0,'C');
        
    }
    }

    include_once '../Controladores/ControladorAlimento.php';
    $datosAlimentos = TodosAlimentos();
    

    $pdf = new PDF('L','mm','A4');
    $pdf-> AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',7);
    $i = 1;
    foreach($datosAlimentos as $Alimentos){
        if($i % 2 == 0){
            $pdf->SetFillColor(255,255,255);
        }else{
            $pdf->SetFillColor(226,239,217);
        }
        $pdf->Cell(10, 10, $Alimentos['ali_id'],1,0,'C',true);
        $pdf->Cell(30, 10, $Alimentos['ali_nombre'],1,0,'C',true);
        $pdf->Cell(20, 10, $Alimentos['PaqA_nombre'],1,0,'C',true);
        $pdf->Cell(25, 10, $Alimentos['ali_clasificacionA'],1,0,'C',true);
        $pdf->Cell(15, 10, $Alimentos['ali_stock'],1,0,'C',true);
        $pdf->Cell(20, 10, $Alimentos['ali_stockMinimo'],1,0,'C',true);
        $pdf->Cell(20, 10, $Alimentos['ali_qOptima'],1,0,'C',true);
        $pdf->Cell(30, 10, $Alimentos['ali_consumoMensual'],1,0,'C',true);
        $pdf->Cell(25, 10, $Alimentos['ali_costoPedido'],1,0,'C',true);
        $pdf->Cell(30, 10, $Alimentos['ali_costoMantenimiento'],1,0,'C',true);
        $pdf->Cell(30, 10, $Alimentos['ali_entregaDias'],1,0,'C',true);
        $pdf->Cell(20, 10, $Alimentos['ali_fechaVencimiento'],1,1,'C',true);
        
        $i++;
    }
    $pdf->Output();




?>