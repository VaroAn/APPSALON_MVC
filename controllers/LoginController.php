<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
          
        $alertas = [];
       
        $auth = new Usuario;
        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            $auth = new Usuario($_POST);

            $alertas=$auth->validarLogin();
            
            if(empty($alertas)){
                $usuario = Usuario::where('email',$auth->email);
                if($usuario){
                    if($usuario->verificarPassVeri($auth->contraseña)){
                        //auteniticar usuario
                        session_start();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre." ".$usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        //reedireccionamiento

                        if($usuario->admin === "1"){
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                            
                        }else{
                            header('Location: /cita');
                        }

                    }
                }else{
                    Usuario::setAlerta('error','Usuario no encontrado');
                }

            }

        }
        
        $alertas = Usuario::getAlertas();
        
        $router->render('auth/login',[
            'auth' => $auth,
            'alertas' => $alertas    
        ]);
        
    }

    public static function logout(){
        session_start();

        $_SESSION=[];

        header('Location:/');
    }

    public static function olvido(Router $router){
        $alertas = [];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if(empty($alertas)){
                $usuario = Usuario::where('email',$auth->email);

                if($usuario&&$usuario->confirmado==="1"){

                    //generar token
                    $usuario->crearToken();
                    $usuario->guardar();

                    //Enviar el email
                    $email = new Email($usuario->email,$usuario->nombre,$usuario->token);
                    $email->enviarI();

                    //Alerta de exito
                    Usuario::setAlerta('exito','Se enviaron instrucciones a tu correo');
                }else{
                    Usuario::setAlerta('error','Usuario no encontrado o no esta confirmado');
                }
            }


        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/olvide',[
            'alertas' => $alertas
        ]);
    }

    public static function recuperar(Router $router){
        $alertas = [];

        $token = s($_GET['token']);

        $usuario=Usuario::where('token',$token);
       
        $error = false ;
        if(!$usuario){
            //Mostrar mensaje de error
            Usuario::setAlerta('error','Token no Valido');
            $error = true;
        }
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $pass = new Usuario($_POST);
            $alertas=$pass->confirmarPass();
                if(empty($alertas)){
                    $usuario->contraseña = $pass->contraseña;
                    $usuario->hashPass();
                    //Mostrar confirmacion
                    $usuario->token=null;
                    $resultado=$usuario->guardar();
                    if($resultado){
                        header('Location: /');
                        Usuario::setAlerta('exito','Cuenta Reestablecida correctamente');
                    }
                }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/recuperar',[
            'alertas' => $alertas,
            'error' => $error
        ]);
    }
    
    public static function crear(Router $router){

        $usuario = new Usuario;

        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD']==='POST'){
        
            $usuario -> sincronizar($_POST);
            $alertas = $usuario -> validar();

            if(empty($alertas)) {
                $resultado = $usuario->existeUsuario();
                if(!$resultado){
                    $alertas=$usuario->confirmarPass();
                    if(empty($alertas)){
                        $usuario->hashPass();

                        //generar token unico
                        $usuario -> crearToken();

                        //enviar email

                        $email= new Email($usuario->nombre, $usuario->email, $usuario->token);

                        $email->enviarConfirmacion();

                        //Crear el usuario
                        $resultado = $usuario->guardar();
                        if($resultado){
                            header('Location: /mensaje');
                        }
                    }
                }else{
                    $alertas = Usuario::getAlertas();
                }
            }

            
        }

        $router->render('auth/crear-cuenta',[
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router){
        $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router){

        $alertas = [];

        $token = s($_GET['token']);

        $usuario=Usuario::where('token',$token);

        if(!$usuario){
            //Mostrar mensaje de error
            Usuario::setAlerta('error','Token no Valido');
        }else{
            //Mostrar confirmacion
            $usuario->confirmado="1";
            $usuario->token=null;
            $usuario->guardar();
            Usuario::setAlerta('exito','Cuenta Confirmada correctamente');
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmar-cuenta',[
            'alertas' => $alertas
        ]);
    }
}