<?php  

// EXAMPLE: // EXAMPLE: /API/sendForm
// METHOD: POST
// DATA = {name, email, tel, cel, message}

// Allow cross origin to send data from model to the controller
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: POST");
header("Allow: POST");
$method = $_SERVER['REQUEST_METHOD'];
if($method != "POST") {
    header("HTTP/1.1 404 OK");
    die();
}

include_once ('./phpmailer/data.php');
require("./phpmailer/class.phpmailer.php");
require("./phpmailer/class.smtp.php");

// Notificar solamente errores de ejecución
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$newData = new Data();


   $name = $_POST["nombre"]; 
   $subname = $_POST["apellido"];
   $tel = $_POST["tel"];
   $email = $_POST["user_mail"];
   $msg = $_POST["user_message"];

   // Valores enviados desde el formulario
if ( !isset($name) || !isset($email) || !isset($msg)) {
   header("HTTP/1.1 401 OK");
   $newData->updateStatus(401, "Complete todos los campos obligatorios.");
   echo json_encode($newData, JSON_PRETTY_PRINT);
   die();
}
// Datos de la cuenta de correo utilizada para enviar vía SMTP
$smtpHost = "grillo.avnam.net"; // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "info@tejasverdes.com.ar";  // Mi cuenta de correo
$smtpClave = "tejas2012";  // Mi contraseña

// Email donde se enviaran los datos cargados en el formulario de contacto
$emailDestino = "deruvodaniel@gmail.com";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 465; 
$mail->SMTPSecure = 'ssl';
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";


// VALORES A MODIFICAR //
$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;

$mail->From = $email; // Email desde donde envío el correo.
$mail->FromName = $name;
$mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario

$mail->Subject = "Consulta recibida desde su Pagina Web"; // Este es el titulo del email.
$nombreHtml = nl2br($name);
$emailHtml = nl2br($email);
$telefonoHtml = nl2br($tel);
$subname = nl2br($subname);
$mensajeHtml = nl2br($msg);
$mail->Body = "Nombre: {$nombreHtml} <br /> Apellido: {$subname} <br /> Email: {$emailHtml} <br /> Telefono: {$telefonoHtml} <br />  Consulta: {$mensajeHtml} <br /><br />Formulario de contacto completado desde www.tejasverdes.com.ar<br />"; // Texto del email en formato HTML
$mail->AltBody = "{$msg} \n\n"; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //

$estadoEnvio = $mail->Send(); 


 if($estadoEnvio){
   header("HTTP/1.1 200 OK");
  $returnData = "Su consulta fue enviada correctamente.";
   $newData->updateStatus(200, $returnData);
   echo json_encode($newData, JSON_PRETTY_PRINT);
} else {
 header("HTTP/1.1 500 OK");
echo 'Mailer Error: ' . $mail->ErrorInfo;
$newData->updateStatus(500, "Error al enviar su consulta.");
$newData->updateStatus(500, $mail->ErrorInfo);
echo json_encode($newData, JSON_PRETTY_PRINT);
}

