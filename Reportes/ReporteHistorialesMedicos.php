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
        $this->Cell(235,20,'Reporte de los Historiales medicos',0,0,'C',true);

        $this->SetFont('Arial','B',10);
        $this->Cell(20,20,date("d")."-".date("m")."-".date("Y"),0,0,'C',true);
        $this->Image('logo2.jpeg',10,10,22);
        // Salto de línea
        $this->Ln(25);


        $this->SetTextColor(255,255,255);
        $this->SetFillColor(28,158,68);
        

        $this->SetFont('Arial','',8);

        $this->Cell(10, 10, 'ID',1,0,'C',true);
        $this->Cell(40, 10, 'EMPLEADO',1,0,'C',true);
        $this->Cell(25, 10, 'ANIMAL',1,0,'C',true);
        $this->Cell(35, 10, 'APODO',1,0,'C',true);
        $this->Cell(40, 10, 'HABITAT',1,0,'C',true);
        $this->Cell(25, 10, 'MEDICAMENTO',1,0,'C',true);
        $this->Cell(30, 10, 'ADMINISTRACION',1,0,'C',true);
        $this->Cell(20, 10, 'CANTIDAD',1,0,'C',true);
        $this->Cell(25, 10, 'ENFERMEDAD',1,0,'C',true);
        $this->Cell(25, 10, 'FECHA',1,1,'C',true);

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

    include_once '../Controladores/ControladorHistorialMedico.php';
    $datosHistoriales= TodosHistorialesMedicos();
    

    $pdf = new PDF('L','mm','A4');
    $pdf-> AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',8);
    $i = 1;
    foreach($datosHistoriales as $historiales){
        if($i % 2 == 0){
            $pdf->SetFillColor(255,255,255);
        }else{
            $pdf->SetFillColor(226,239,217);
        }
        $pdf->Cell(10, 10, $historiales['hmed_id'],1,0,'C',true);
        $pdf->Cell(40, 10, $historiales['emp_nombre']." ".$historiales['emp_apellidoP'],1,0,'C',true);
        $pdf->Cell(25, 10, utf8_decode($historiales['ani_nombre']),1,0,'C',true);
        $pdf->Cell(35, 10, $historiales['ani_apodo'],1,0,'C',true);
        $pdf->Cell(40, 10, $historiales['hab_nombre'],1,0,'C',true);
        $pdf->Cell(25, 10, $historiales['med_nombre'],1,0,'C',true);
        $pdf->Cell(30, 10, $historiales['med_tipoAdministracion'],1,0,'C',true);
        $pdf->Cell(20, 10, $historiales['hmed_cantidad'],1,0,'C',true);
        $pdf->Cell(25, 10, $historiales['hmed_enfermedad'],1,0,'C',true);
        $pdf->Cell(25, 10, $historiales['hmed_fecha'],1,1,'C',true);
        
        $i++;
    }
    $pdf->Output();




?>