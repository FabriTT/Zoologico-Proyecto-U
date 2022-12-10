<?php
    require('FPDF/fpdf.php');

    

    class PDF extends FPDF
    {
    // Cabecera de página
    function Header()
    {
        
        include_once '../Controladores/ControladorAnimal.php';

        $id=(isset($_GET['id']))?$_GET['id']:"";

    
        $animal = Animal($id);
        

        // Logo
        
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        

        //color
        $this->SetTextColor(255,255,255);
        $this->SetFillColor(28,158,68);
        $this->Cell(276,10,'HISTORIAL MEDICO',1,1,'C',true);

        $this->SetFillColor(255,255,255);
        $this->Cell(40,8);

        $this->SetTextColor(255,255,255);
        $this->SetFillColor(28,158,68);
        $this->Image('../Vistas/Imagenes/'.$animal['ani_imagen'],10,20,40,32);
        // Título
        $this->SetFont('Arial','B',12);
        $this->Cell(59,8,'ANIMAL:',1,0,'C',true);
        
        $this->SetTextColor(0,0,0);
        $this->SetFillColor(226,239,217);

        $this->SetFont('Arial','',12);
        $this->Cell(59,8,UTF8_DECODE($animal['ani_nombre']),1,0,'C',true);

        $this->SetTextColor(255,255,255);
        $this->SetFillColor(28,158,68);

        $this->SetFont('Arial','B',12);
        $this->Cell(59,8,"ESPECIE:",1,0,'C',true);

        $this->SetTextColor(0,0,0);
        $this->SetFillColor(226,239,217);

        $this->SetFont('Arial','',12);
        $this->Cell(59,8,$animal['ani_especie'],1,1,'C',true);

        $this->SetFillColor(255,255,255);
        $this->Cell(40,8);

        $this->SetTextColor(255,255,255);
        $this->SetFillColor(28,158,68);

        $this->SetFont('Arial','B',12);
        $this->Cell(59,8,'CLASIFICACION:',1,0,'C',true);

        $this->SetTextColor(0,0,0);
        $this->SetFillColor(226,239,217);
        
        $this->SetFont('Arial','',12);
        $this->Cell(59,8,$animal['ani_clasificacionVertebral'],1,0,'C',true);

        $this->SetTextColor(255,255,255);
        $this->SetFillColor(28,158,68);

        $this->SetFont('Arial','B',12);
        $this->Cell(59,8,"ALIMENTACION:",1,0,'C',true);

        $this->SetTextColor(0,0,0);
        $this->SetFillColor(226,239,217);

        $this->SetFont('Arial','',12);
        $this->Cell(59,8,$animal['ani_tipoAlimentacion'],1,1,'C',true);

        $this->SetFillColor(255,255,255);
        $this->Cell(40,8);

        $this->SetTextColor(255,255,255);
        $this->SetFillColor(28,158,68);

        $this->SetFont('Arial','B',12);
        $this->Cell(59,8,"APODO:",1,0,'C',true);

        $this->SetTextColor(0,0,0);
        $this->SetFillColor(226,239,217);

        $this->SetFont('Arial','',12);
        $this->Cell(177,8,$animal['ani_apodo'],1,1,'C',true);

        $this->SetFillColor(255,255,255);
        $this->Cell(40,8);

        $this->SetTextColor(255,255,255);
        $this->SetFillColor(28,158,68);

        $this->SetFont('Arial','B',12);
        $this->Cell(59,8,"NACIMIENTO:",1,0,'C',true);

        $this->SetTextColor(0,0,0);
        $this->SetFillColor(226,239,217);

        $this->SetFont('Arial','',12);
        $this->Cell(177,8,$animal['ani_fechaNacimiento'],1,1,'C',true);


        // Salto de línea
        $this->Ln();


        $this->SetTextColor(255,255,255);
        $this->SetFillColor(28,158,68);
        

        $this->SetFont('Arial','',12);

        $this->Cell(25, 10, 'IMAGEN',1,0,'C',true);
        $this->Cell(45, 10, 'EMPLEADO',1,0,'C',true);
        $this->Cell(40, 10, 'MEDICAMENTO',1,0,'C',true);
        $this->Cell(45, 10, 'ADMINISTRACION',1,0,'C',true);
        $this->Cell(25, 10, 'CANTIDAD',1,0,'C',true);
        $this->Cell(40, 10, 'ENFERMEDAD',1,0,'C',true);
        $this->Cell(25, 10, 'ESTADO',1,0,'C',true);
        $this->Cell(30, 10, 'FECHA',1,1,'C',true);

        
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
    $datosHistoriales = Historiales($id);
    

    $pdf = new PDF('L','mm','A4');
    $pdf-> AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',12);
    $i = 1;
    foreach($datosHistoriales as $historial){
        if($i % 2 == 0){
            $pdf->SetFillColor(255,255,255);
        }else{
            $pdf->SetFillColor(226,239,217);
        }
        $pdf->Cell(25, 25, $pdf->Image('../Vistas/Imagenes/'.$historial['emp_imagen'],$pdf->GetX(), $pdf->GetY(),25,25) ,0,0);
        $pdf->Cell(45, 25, $historial['emp_nombre']." ".$historial['emp_nombre'],1,0,'C',true);
        $pdf->Cell(40, 25, utf8_decode($historial['med_nombre']),1,0,'C',true);
        $pdf->Cell(45, 25, $historial['med_tipoAdministracion'],1,0,'C',true);
        $pdf->Cell(25, 25, $historial['hmed_cantidad'],1,0,'C',true);
        $pdf->Cell(40, 25, $historial['hmed_enfermedad'],1,0,'C',true);
        $pdf->Cell(25, 25, $historial['hmed_situacion'],1,0,'C',true);
        $pdf->Cell(30, 25, $historial['hmed_fecha'],1,1,'C',true);
        

        
        $i++;
    }

    $pdf->Output();




?>