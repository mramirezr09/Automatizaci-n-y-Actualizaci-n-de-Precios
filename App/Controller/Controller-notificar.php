<?php
  require_once '../../vendor/autoload.php';
  require_once('../../Static/ConstGlobal.php');
  require_once('../../App/Controller/funcion_DB.adg.function.php');
  use PHPMailer\PHPMailer\PHPMailer; //espacio de memoria / importación de clase PHPMailer
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception; //espacio de memoria / importación de clase Exception

  $conn = new mysqli(SERVER,USER,PASS_,BBDD_MSSQL);


  $idnn = $_GET['idnn'];
  $query = "
  UPDATE `adg.archivos`
  SET
    FK_IdStatus_Archivo = 2
  WHERE
    PK_IdArchivo = $idnn
  ";
  // echo $query;
  $upd = $conn -> query($query);

  $mail = "SELECT
    t2.Nombre_Empresa as 'fie',
    t3.Nombre_Area as 'fia',
    Nombre_Archivo as 'na'
  FROM `adg.archivos` t1
  left join `adg.empresa`t2 on t2.PK_IdEmpresa = t1.FK_IdEmpresa
  left join `adg.area`t3 on t3.PK_IdArea = t1.FK_IdArea
  WHERE
    PK_IdArchivo = '$idnn'
  ";
  $mail = $conn -> query($mail);

  while ($m = mysqli_fetch_array($mail)) {
    $empresa = $m['fie'];
    $area = $m['fia'];
    $namef = $m['na'];
  }

  //envio de correo
  $mail = new PHPMailer(true);
  try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.alimentosdelagranja.com.mx';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'proyecto-adg@alimentosdelagranja.com.mx';                     //SMTP username
    $mail->Password   = '/*/*po13do73';                               //SMTP password
    $mail->SMTPAutoTLS = false;
    $mail->SMTPSecure = false; //PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 25;


    //Recipients
    $mail->setFrom('proyecto-adg@alimentosdelagranja.com.mx', 'Proyecto-ADG');
    $mail->addAddress('proyecto-adg@alimentosdelagranja.com.mx', 'Mauricio Ramírez');     //Add a recipient
    // $mail->addAddress('rigonzalez@alimentosdelagranja.com.mx', 'Rogelio Gonzalez');     //Add a recipient

    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');
    //
    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = utf8_decode('ACTUALIZACIÓN DE PRECIOS');
    $mail->Body    = utf8_decode("Este es un correo de notificación para revisar <b>La actualización de precios.</b>
    <br/>
    <br/>
    Se ha cargado el archivo correspondiente:
    <br/>
    Empresa: ".$empresa."
    <br/>
    Area: ".$area."
    <br/>
    Nombre_Archivo: ".$namef."
    <br/>
    <br/>
    Acceda a la siguiente liga para su revisión <a href='http://10.0.0.178/Proyecto/'>Sistema de Carga y Actualizacion de Precios</a>.
    <br/>
    <br/>
    Este es un correo automático, favor de no contestar.
    <br/>
    <br/>
    Saludos.");
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Correo envíado exitosamente!';
  } catch (Exception $e) {
    echo "Error al envíar Correo, favor de notificar al area de sistemas. Mailer Error: {$mail->ErrorInfo}";
  }
