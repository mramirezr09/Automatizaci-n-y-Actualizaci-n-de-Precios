<?php
  require_once '../../vendor/autoload.php';
  require_once('../../App/Model/Modelo_principal.adg.model.php');
  use PHPMailer\PHPMailer\PHPMailer; //espacio de memoria / importación de clase PHPMailer
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception; //espacio de memoria / importación de clase Exception

  class updRegistros extends modelADG {
    public function updR() {
      $res = $_GET['res'];
      $url = 'dashboardAuto/';
      $fechaA = date("Y-m-d H:m:s");
      $pka = $_GET['pka'];
      $par = $_GET['par'];
      $p = reset($_POST);


      if ($par == 3) {
        for ($i= $p; $i <= $res; $i++) {
          $pkr = $_POST['pkr'.$i];
          $pre = $_POST['pre'.$i];

          // echo $pkr.' ';
          // echo '<br/>';

          $insert = array(
            'pkr' => $pkr,
            'pre' => $pre,
            'fechaA' => $fechaA
          );
          // print_r($insert);
          $guardap = modelADG :: insertpc($insert);
        }
        // exit;
      }
      else if($par == 4) {
        for ($i= $p; $i <= $res; $i++) {
          $pkr = $_POST['pkr'.$i];
          $pre = $_POST['pre'.$i];

          // echo $pkr.' ';
          // echo $pre.'<br/>';

          $insert = array(
            'pkr' => $pkr,
            'pre' => $pre,
            'fechaA' => $fechaA
          );
          $guardap = modelADG :: insertp($insert);
        }
      }


      $status = array(
        'pka' => $pka,
        'status' => 4,
        'fechaA' => $fechaA
      );
      $guardap = modelADG :: upds($status);
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
        $mail->addAddress('rigonzalez@alimentosdelagranja.com.mx', 'Rogelio Gonzalez');     //Add a recipient
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
        $mail->Subject = utf8_decode('ACTUALIZACIÓN DE PRECIOS - AUTORIZACIÓN');
        $mail->Body    = utf8_decode('Este es un correo de notificación para revisar <b>La actualización de precios.</b>
        <br/>
        <br/>
        Se ha autorizado el archivo correspondiente para su actualización.
        <br/>
        <br/>
        Acceda a la siguiente liga para su revisión <a href="http://10.0.0.178/Proyecto/">Sistema de Carga y Actualizacion de Precios</a>.
        <br/>
        <br/>
        Este es un correo automático, favor de no contestar.
        <br/>
        <br/>
        Saludos.');
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Correo envíado exitosamente!';
      } catch (Exception $e) {
        echo "Error al envíar Correo, favor de notificar al area de sistemas. Mailer Error: {$mail->ErrorInfo}";
      }

      return $alerta = modelADG :: alertas('Datos autorizados!',$url);
    }
  }
