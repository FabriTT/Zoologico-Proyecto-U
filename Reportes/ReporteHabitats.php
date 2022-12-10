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
        $this->Cell(235,20,'Reporte de los Habitats',0,0,'C',true);

        $this->SetFont('Arial','B',10);
        $this->Cell(20,20,date("d")."-".date("m")."-".date("Y"),0,0,'C',true);
        $this->Image('logo2.jpeg',10,10,22);
        // Salto de línea
        $this->Ln(25);


        $this->SetTextColor(255,255,255);
        $this->SetFillColor(28,158,68);
        

        $this->SetFont('Arial','',12);

        $this->Cell(10, 10, 'ID',1,0,'C',true);
        $this->Cell(55, 10, 'HABITAT',1,0,'C',true);
        $this->Cell(30, 10, 'ANIMAL',1,0,'C',true);
        $this->Cell(45, 10, 'CLASIFICACION',1,0,'C',true);
        $this->Cell(30, 10, 'CAPACIDAD',1,0,'C',true);
        $this->Cell(45, 10, 'HORARIO LIMPIEZA',1,0,'C',true);
        $this->Cell(60, 10, 'HORARIO ALIMENTACION',1,1,'C',true);
        
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

    include_once '../Controladores/ControladorHabitat.php';
    $datosHabitats = TodosHabitat();
    

    $pdf = new PDF('L','mm','A4');
    $pdf-> AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',12);
    $i = 1;
    foreach($datosHabitats as $habitats){
        if($i % 2 == 0){
            $pdf->SetFillColor(255,255,255);
        }else{
            $pdf->SetFillColor(226,239,217);
        }
        $pdf->Cell(10, 10, $habitats['hab_id'],1,0,'C',true);
        $pdf->Cell(55, 10, $habitats['hab_nombre'],1,0,'C',true);
        $pdf->Cell(30, 10, utf8_decode($habitats['hab_nombreA']),1,0,'C',true);
        $pdf->Cell(45, 10, $habitats['hab_clasificacionAmbiente'],1,0,'C',true);
        $pdf->Cell(30, 10, $habitats['hab_capacidad'],1,0,'C',true);
        $pdf->Cell(45, 10, $habitats['hab_horarioLimpieza'],1,0,'C',true);
        $pdf->Cell(60, 10, $habitats['hab_horarioAlimentacion'],1,1,'C',true);
        
        $i++;
    }

    $pdf->Output();




?>