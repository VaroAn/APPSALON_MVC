<?php 
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){

        //Crear objeto email
        $mail = new PHPMailer();
        $mail-> isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '0908cc7b5d5fe4';
        $mail->Password = '61cf71ac43c22d';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com','AppSalon.com');
        $mail->Subject = 'Confirma tu cuenta';

        //setHtml

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>"; 
        $contenido .="<p><strong>Hola ".$this->nombre."</strong> Has Creado tu Cuenta en AppSalon,
                      solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .="<p>Preciona aqui: <a href='http://localhost:3000/confirmar-cuenta?token=".
                     $this->token."'>Confirmar Cuenta</a></p>";
        $contenido .="<p>Si tu no solicitaste esta alta, ignora este mensaje</p>";
        $contenido .="</html>";
        $mail->Body=$contenido;

        //Enviar Email
        $mail->send();
        
    }

    public function enviarI(){
        //Crear objeto email
        $mail = new PHPMailer();
        $mail-> isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '0908cc7b5d5fe4';
        $mail->Password = '61cf71ac43c22d';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com','AppSalon.com');
        $mail->Subject = 'Reestablece tu contraseña';

        //setHtml

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>"; 
        $contenido .="<p><strong>Hola ".$this->nombre."</strong> Has Solicitiado reestablecer tu contraseña,
                      solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .="<p>Preciona aqui: <a href='http://localhost:3000/recuperar?token=".
                     $this->token."'>Reestablecer Contraseña</a></p>";
        $contenido .="<p>Si tu no solicitaste este cambio, ignora este mensaje</p>";
        $contenido .="</html>";
        $mail->Body=$contenido;

        //Enviar Email
        $mail->send();
    }

}