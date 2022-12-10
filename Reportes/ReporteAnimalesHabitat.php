<?php
    require('FPDF/fpdf.php');

    

    class PDF extends FPDF
    {
    // Cabecera de página
    function Header()
    {
        
        include_once '../Controladores/ControladorHabitat.php';

        $id=(isset($_GET['id']))?$_GET['id']:"";

    
        $habitat = Habitat($id);
        

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
        $this->Cell(235,20,$habitat['hab_nombre'],0,0,'C',true);

        $this->SetFont('Arial','B',10);
        $this->Cell(20,20,date("d")."-".date("m")."-".date("Y"),0,0,'C',true);
        $this->Image('logo2.jpeg',10,10,22);
        // Salto de línea
        $this->Ln(25);


        $this->SetTextColor(255,255,255);
        $this->SetFillColor(28,158,68);
        

        $this->SetFont('Arial','',14);

        $this->Cell(10, 10, 'ID',1,0,'C',true);
        $this->Cell(30, 10, 'NOMBRE',1,0,'C',true);
        $this->Cell(30, 10, 'ESPECIE',1,0,'C',true);
        $this->Cell(45, 10, 'APODO',1,0,'C',true);
        $this->Cell(45, 10, 'CLASIFICACION',1,0,'C',true);
        $this->Cell(40, 10, 'ALIMENTACION',1,0,'C',true);
        $this->Cell(35, 10, 'NACIMIENTO',1,0,'C',true);
        $this->Cell(40, 10, 'IMAGEN',1,1,'C',true);

        
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

    include_once '../Controladores/ControladorAnimal.php';
    $id=(isset($_GET['id']))?$_GET['id']:"";
    $datosAnimales = HabitatAnimal($id);
    

    $pdf = new PDF('L','mm','A4');
    $pdf-> AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',14);
    $i = 1;
    foreach($datosAnimales as $Animales){
        if($i % 2 == 0){
            $pdf->SetFillColor(255,255,255);
        }else{
            $pdf->SetFillColor(226,239,217);
        }
        $pdf->Cell(10, 25, $Animales['ani_id'],1,0,'C',true);
        $pdf->Cell(30, 25, utf8_decode($Animales['ani_nombre']),1,0,'C',true);
        $pdf->Cell(30, 25, $Animales['ani_especie'],1,0,'C',true);
        $pdf->Cell(45, 25, $Animales['ani_apodo'],1,0,'C',true);
        $pdf->Cell(45, 25, $Animales['ani_clasificacionVertebral'],1,0,'C',true);
        $pdf->Cell(40, 25, $Animales['ani_tipoAlimentacion'],1,0,'C',true);
        $pdf->Cell(35, 25, $Animales['ani_fechaNacimiento'],1,0,'C',true);
        $pdf->Cell(40, 25, $pdf->Image('../Vistas/Imagenes/'.$Animales['ani_imagen'],$pdf->GetX(), $pdf->GetY(),40,25) ,1,1);

        
        $i++;
    }

    $pdf->Output();




?>