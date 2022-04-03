<?php
  require_once '../../vendor/autoload.php';
  require_once('../../App/Model/Modelo_principal.adg.model.php');
  require_once('../../App/Controller/funcion_DB.adg.function.php');
  use PHPMailer\PHPMailer\PHPMailer; //espacio de memoria / importación de clase PHPMailer
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception; //espacio de memoria / importación de clase Exception

  class actRegistros extends modelADG {
    public function actR() {
      $con = mysqli_connect(SERVER,USER,PASS_,BBDD_MSSQL);

      $url = 'dashboardAdmin/';
      $fechaA = date('Y-m-d H:m:s');
      $pka = $_GET['pkid'];
      $par = $_GET['par'];

      if ($par == 3) {
        $query= "SELECT
          PK_IdRegistroc as 'pkr',
          id_companhia as 'idc',
          id_division as 'idd',
          codigo_proveedor as 'cpr',
          codigo_producto as 'cp',
          almacen as 'a',
          fechad as 'fvd',
          fechah as 'fvh',
          moneda_contrato as 'mc',
          precio_sin_iva as 'psi',
          precio_incluyendo_iva as 'pii'
        FROM proyecto_adg.`adg.registros_compras`
        WHERE FK_IdArchivo = $pka
        ";
        // print_r($query);
        $query = $con -> query($query);

        while($r=mysqli_fetch_array($query)){
          $pkr = $r['pkr'];
          $idc = $r['idc'];
          $idd = $r['idd'];
          $cpr = $r['cpr'];
          $cp = $r['cp'];
          $a = $r['a'];
          $mc = $r['mc'];
          $fvd = $r['fvd'];
          $fvh = $r['fvh'];
          $psi = $r['psi'];
          $pii = $r['pii'];

          $insert = array(
            'idc' => $idc,
            'idd' => $idd,
            'cpr' => $cpr,
            'cp' => $cp,
            'a' => $a,
            'mc' => $mc,
            'fvd' => $fvd,
            'fvh' => $fvh,
            'psi' => $psi,
            'pii' => $pii
          );
          $guardap = modelADG :: actPOP_CONTRACT_PRICES($insert);
          $guardap = modelADG :: actPOP_CONTRACT_PRICE_LINES($insert);
          // exit;
        }
      }
      else if ($par == 4) {
        $query= "SELECT
        id_companhia as 'idc',
        numero_concecutivo as 'nc',
        FK_IdCodigo_cliente as 'cc',
        almacen as 'a',
        codigo_producto as 'cp',
        moneda_contrato as 'mc',
        unidad_medida_kg as 'umk',
        codigo_precio as 'cpr',
        descripcion as 'd',
        fecha_valida_desde as 'fvd',
        fecha_valida_hasta as 'fvh',
        precio as 'p'
        FROM `adg.registros`
        WHERE FK_IdArchivo = $pka
        ";
        // print_r($query);
        $query = $con -> query($query);

        while($r=mysqli_fetch_array($query)){
          $idc = $r['idc'];
          $nc = $r['nc'];
          $cc = $r['cc'];
          $a = $r['a'];
          $cp = $r['cp'];
          $mc = $r['mc'];
          $umk = $r['umk'];
          $cpr = $r['cpr'];
          $d = $r['d'];
          $fvd = $r['fvd'];
          $fvh = $r['fvh'];
          $p = $r['p'];

          $insert = array(
            'idc' => $idc,
            'nc' => $nc,
            'cc' => $cc,
            'a' => $a,
            'cp' => $cp,
            'mc' => $mc,
            'umk' => $umk,
            'cpr' => $cpr,
            'd' => $d,
            'fvd' => $fvd,
            'fvh' => $fvh,
            'p' => $p
          );

          $guardap = modelADG :: actSOP_PRICES($insert);
          $guardap = modelADG :: actSOP_PRICE_LINES($insert);
        }
      }

      $status = array(
        'pka' => $pka,
        'status' => 5,
        'fechaA' => $fechaA
      );
      $guardap = modelADG :: upds($status);
      //envio de correo

      $mail = new PHPMailer(true);
      try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'proyectoadgprueba@gmail.com';                     //SMTP username
        $mail->Password   = '123456789asd+';                               //SMTP password
        $mail->SMTPSecure = 'tls';//PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('proyectoadgprueba@gmail.com', 'proyecto_adg');
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
        $mail->Subject = utf8_decode('ACTUALIZACIÓN DE PRECIOS - ACTUALIZACIÓN');
        $mail->Body    = utf8_decode('Este es un correo de notificación para revisar <b>La actualización de precios.</b>
        <br/>
        <br/>
        Se han actualizado los precios de venta, favor de validar en sistema ERP.
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

      return $alerta = modelADG :: alertas('Datos Actualizados en Sistema ERP!',$url);
    }
  }
