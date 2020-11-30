<?php
$id =  $_GET['id'];

if (!filter_var($id, FILTER_VALIDATE_INT)) :
    die("Error");
else :
require('inc/fpdf/fpdf.php');
// Conexion con la base de datos
include 'funciones/funciones.php';
$resultado = obtenerExamen($id);
$examenEspecifico = $resultado->fetch_assoc();
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,utf8_decode('Reporte de Examen Médico'),0,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer(){
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
// Linea PDF
if ($resultado->num_rows) :
$pdf->Cell(0,10,utf8_decode('Examen de: ') . utf8_decode($examenEspecifico['nombreTipoExamen'] . ". "), 0 , 1);
$pdf->Cell(0,10,'Nombre del Paciente: ' . utf8_decode($examenEspecifico['nombrePaciente'] . " " . $examenEspecifico['apellidoPaciente'] . ". "), 0 , 1);
$pdf->Cell(0,10, utf8_decode('Identificación: ' . $examenEspecifico['identificacion']), 0 , 1);
$pdf->Cell(0,10, utf8_decode("Edad: " . $examenEspecifico['edad'] . ". "), 0 , 1);
$pdf->Cell(0,10,utf8_decode('Información del Examen: ') . utf8_decode($examenEspecifico['informacionExamen'] ), 0 , 1);
else :
    $pdf->Cell(0,10,'Paciente: ' . utf8_decode(" Error el examen no existe paciente. "), 0 , 1);
endif; // Del $examenEspecifico->num_rows
$pdf->Output('F', 'reportes/examen.pdf'); // Guarda el pdf en la carpeta especificada.

endif; // Del $id;

// ENVIAR CORREO AL CLIENTE
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output SMTP::DEBUG_SERVER
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'tucorreo@gmail.com';                     // SMTP username
    $mail->Password   = 'tucontraseña';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('av85699@gmail.com', 'Adm de Examenes');
    $mail->addAddress($examenEspecifico['email'], $examenEspecifico['nombrePaciente'] . " " . $examenEspecifico['apellidoPaciente']);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Tu Examen Medico';
    $mail->Body    = '<h1>Hola, ' . $examenEspecifico['nombrePaciente'] . " " . $examenEspecifico['apellidoPaciente'] .'</h1> <p>Puedes descargar tu examen.</p>';
    $mail->addAttachment('reportes/examen.pdf', 'Examen Medico'); 
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    header('Location:mostrar-examenes.php?c=true');
} catch (Exception $e) {
    header('Location:mostrar-examenes.php?c=false');
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
