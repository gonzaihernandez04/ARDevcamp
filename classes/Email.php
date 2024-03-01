<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;
    public $mail;
    
    public function __construct($email, $nombre, $token)
    {
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = $_ENV['EMAIL_HOST'];
       $this->mail->SMTPAuth = true;
        $this->mail->Port = $_ENV['EMAIL_PORT'];
        $this->mail->Username = $_ENV['EMAIL_USER'];
        $this->mail->Password = $_ENV['EMAIL_PASS'];
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {


         $this->mail->setFrom('ardevcamp@gmail.com');
         $this->mail->addAddress($this->email, $this->nombre);
         $this->mail->Subject = 'Confirma tu Cuenta';

         // Set HTML
         $this->mail->isHTML(TRUE);
         $this->mail->CharSet = 'UTF-8';

         $contenido = '<html>';
         $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has Registrado Correctamente tu cuenta en ArgDevCamp; pero es necesario confirmarla</p>";
         $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a>";       
         $contenido .= "<p>Si tu no creaste esta cuenta; puedes ignorar el mensaje</p>";
         $contenido .= '</html>';
         $this->mail->Body = $contenido;

         //Enviar el mail
         $this->mail->send();

    }

    public function enviarInstrucciones() {


    
        $this->mail->setFrom('ardevcamp@gmail.com');
        $this->mail->addAddress($this->email, $this->nombre);
        $this->mail->Subject = 'Reestablece tu password';

        // Set HTML
        $this->mail->isHTML(TRUE);
        $this->mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/reestablecer?token=" . $this->token . "'>Reestablecer Password</a>";        
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
        $contenido .= '</html>';
        $this->mail->Body = $contenido;

        //Enviar el mail
        $this->mail->send();
    }
}