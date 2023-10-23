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
        $mail->Username = '2a5c7a13352985';
        $mail->Password = '4ce1d93364d';
    
        $mail->setFrom('cuetas@coastalCoffe.com');//quien manda ek email
        $mail->addAddress('cuantas@coastalCoffe','coastal@coffee.com');
        $mail->Subject ='Comfirma Tu cuenta';

        //set html
        $mail->isHTML(TRUE);
        $mail->CharSet='UTF-8';

      
        $contenido="<html>";
        $contenido.="<p><strong>Hola".$this->nombre."</strong>Has creado tu cuenta en coastal cooffe solo deves confirmarla presionando el siguiente enlace</p>";
        $contenido.="<p>Presiona aqui : 
            <a href='http://localhost:3000/confirmar-cuenta?token=".$this->token."'>Confirma tu cuenta</a> </p>";
        $contenido.="<p>Si tu  no solicitaste esta cuenta ,ignora este mensaje</P>";
        $contenido.="</html>";


       // $mail->Body=$contenido;

        $mail->send();


     }
   }

?>