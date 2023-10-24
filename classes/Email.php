<?php

   namespace Classes;

   use PHPMailer\PHPMailer\PHPMailer;

   class Email{

   
    public $nombre;
    public $email;
    public $token;


    // constructor que toma toma como parametros el email nombre y token
    public function __construct($email,$nombre,$token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;

    }

    public function enviarConfirmacion(){
        //crear el objeto del email
       
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '930732163a3cf6';
        $mail->Password = '8d9cc47d4ab4e7';
    
        $mail->setFrom('cuentas@coastalCoffe.com');//quien manda el email
        $mail->addAddress('cuentas@coastalCoffe.com','coastalcoffee.com');
        $mail->Subject ='Comfirma Tu cuenta';

        //set html
        $mail->isHTML(TRUE);
        $mail->CharSet='UTF-8';

      
        $contenido="<html>";
        $contenido.="<p><strong>Hola ".$this->nombre."</strong> Has creado tu cuenta en coastal coffee solo deves confirmarla presionando el siguiente enlace</p>";
        $contenido.="<p>Presiona aqui : 
            <a href='http://localhost:3000/confirmar-cuenta?token=".$this->token."'>Confirma tu cuenta</a> </p>";
        $contenido.="<p>Si tu  no solicitaste esta cuenta ,ignora este mensaje</P>";
        $contenido.="</html>";

        $mail->Body = $contenido;


       // enviar el email

        $mail->send();


     }

     public function enviarInstrucciones(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '930732163a3cf6';
        $mail->Password = '8d9cc47d4ab4e7';
    
        $mail->setFrom('cuentas@coastalCoffe.com');//quien manda el email
        $mail->addAddress($this->email,'coastalcoffee.com');
        $mail->Subject ='Restablecer email';

        //set html
        $mail->isHTML(TRUE);
        $mail->CharSet='UTF-8';

      
        $contenido="<html>";
        $contenido.="<p><strong>Hola ".$this->nombre."</strong> Has solicitado reestablecer tu password, , sigue el siguiente enlace para hacerlo</p>";
        $contenido.="<p>Presiona aqui : 
            <a href='http://localhost:3000/recuperar?token=".$this->token."'>Restablecer password</a> </p>";
        $contenido.="<p>Si tu  no solicitaste esta cuenta ,ignora este mensaje</P>";
        $contenido.="</html>";

        $mail->Body = $contenido;


       // enviar el email

        $mail->send();

     }
   }

?>