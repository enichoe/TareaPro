<?php


namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;


class Email {
    protected $email;
    protected $nombre;
    protected $token;
    

    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
           //credenciales
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV['EMAIL_PORT'];
            $mail->Username = $_ENV['EMAIL_USER'];;
            $mail->Password = $_ENV['EMAIL_PASS'];;

            $mail->setFrom('cuentas@uptask.com');
            $mail->addAddress('cuenta@uptask.com', 'uptask.com');
            $mail->Subject = 'Confirmación de cuenta';
            $mail->isHTML(TRUE);
            $mail->CharSet = 'UTF-8';

            $contenido = '<html>';
            $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenta en Uptask, solo debes confirmar en el siguiente enlace:</p>";
            $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['APP_URL'] . "/confirmar?token=" . $this->token . "'>Confirmar cuenta</a></p>";
            $contenido .= "<p>Si no creaste esta cuenta, ignora este mensaje.</p>";
            $contenido .= '</html>';

            $mail->Body = $contenido;

            // Enviar el mail
            $mail->send();
        
    }

    public function enviarInstrucciones() {
        //credenciales
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];;
        $mail->Password = $_ENV['EMAIL_PASS'];;

         $mail->setFrom('cuentas@uptask.com');
         $mail->addAddress('cuenta@uptask.com', 'uptask.com');
         $mail->Subject = 'Restablece tu password';
         $mail->isHTML(TRUE);
         $mail->CharSet = 'UTF-8';

         $contenido = '<html>';
         $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Parece que olvidaste tu password, Sigue el siguiente enlace para recuperarlo:</p>";
         $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['APP_URL'] . "/restablecer?token=" . $this->token . "'>Restablecer Pssword</a></p>";
         $contenido .= "<p>Si no creaste esta cuenta, ignora este mensaje.</p>";
         $contenido .= '</html>';

         $mail->Body = $contenido;

         // Enviar el mail
         $mail->send();
     
 }
}
