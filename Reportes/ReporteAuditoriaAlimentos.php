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
        

        $this->SetFont('Arial','',6);

        $this->Cell(5, 10, 'ID',1,0,'C',true);
        $this->Cell(25, 10, 'ALIMENTO',1,0,'C',true);
        $this->Cell(15, 10, 'EMPAQUE',1,0,'C',true);
        $this->Cell(20, 10, 'CLASIFICAION',1,0,'C',true);
        $this->Cell(15, 10, 'STOCK',1,0,'C',true);
        $this->Cell(15, 10, 'STOCK MIN.',1,0,'C',true);
        $this->Cell(15, 10, 'STOCK MAX.',1,0,'C',true);
        $this->Cell(25, 10, 'CONSUMO MENSUAL',1,0,'C',true);
        $this->Cell(20, 10, 'PEDIDO $$',1,0,'C',true);
        $this->Cell(25, 10, 'MANTENIMIENTO $$',1,0,'C',true);
        $this->Cell(25, 10, 'ENTREGA EN DIAS',1,0,'C',true);
        $this->Cell(20, 10, 'VENCIMINETO',1,0,'C',true);
        $this->Cell(20, 10, 'USUARIO',1,0,'C',true);
        $this->Cell(15, 10, 'ACCION',1,0,'C',true);
        $this->Cell(15, 10, 'FECHA',1,1,'C',true);
        
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
    $datosAlimentos = TodosAuditoriaAlimento();
    

    $pdf = new PDF('L','mm','A4');
    $pdf-> AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',6);
    $i = 1;
    foreach($datosAlimentos as $Alimentos){
        if($i % 2 == 0){
            $pdf->SetFillColor(255,255,255);
        }else{
            $pdf->SetFillColor(226,239,217);
        }
        $pdf->Cell(5, 10, $Alimentos['audi_ali_id'],1,0,'C',true);
        $pdf->Cell(25, 10, $Alimentos['audi_ali_nombre'],1,0,'C',true);
        $pdf->Cell(15, 10, $Alimentos['PaqA_nombre'],1,0,'C',true);
        $pdf->Cell(20, 10, $Alimentos['audi_ali_clasificacionA'],1,0,'C',true);
        $pdf->Cell(15, 10, $Alimentos['audi_ali_stock'],1,0,'C',true);
        $pdf->Cell(15, 10, $Alimentos['audi_ali_stockMinimo'],1,0,'C',true);
        $pdf->Cell(15, 10, $Alimentos['audi_ali_qOptima'],1,0,'C',true);
        $pdf->Cell(25, 10, $Alimentos['audi_ali_consumoMensual'],1,0,'C',true);
        $pdf->Cell(20, 10, $Alimentos['audi_ali_costoPedido'],1,0,'C',true);
        $pdf->Cell(25, 10, $Alimentos['audi_ali_costoMantenimiento'],1,0,'C',true);
        $pdf->Cell(25, 10, $Alimentos['audi_ali_entregaDias'],1,0,'C',true);
        $pdf->Cell(20, 10, $Alimentos['audi_ali_fechaVencimiento'],1,0,'C',true);
        $pdf->Cell(20, 10, $Alimentos['audi_usuario'],1,0,'C',true);
        $pdf->Cell(15, 10, $Alimentos['audi_accion'],1,0,'C',true);
        $pdf->Cell(15, 10, $Alimentos['audi_fecha'],1,1,'C',true);
        
        $i++;
    }
    $pdf->Output();




?>