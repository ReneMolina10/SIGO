<?php
class loginController extends Controller
{
    private $_login;
    public function __construct()
    {
        parent::__construct();
        $this->_login = $this->loadModel('login');
        $this->_view->setTemplate('login');
    }
    public function index()
    {

        $imgs[0] = "rectoria.jpg";
        $imgs[1] = "cozumel.jpg";
        $imgs[2] = "playa.jpg";
        $imgs[3] = "dcs.jpg";
        $imgs[4] = "cancun.jpg";
        $imgs[5] = "carrillo.jpg";

        $numAleatorio = rand(0, 5);
        $imagenFondo = $imgs[$numAleatorio];

        $this->_view->assign('_error', '');

        if ($this->getInt('enviar') == 1) {
            $this->_view->assign('datos', $_POST);

            if (!$this->getAlphaNum('usuario')) {
                $this->_view->assign('_error', 'Debe ingresar su usuario');
                $this->_view->renderizar('index', 'login');
                exit;
            }

            if (!$this->getSql('pass')) {
                $this->_view->assign('_error', 'Debe ingresar su contraseña');
                $this->_view->renderizar('index', 'login');
                exit;
            }

            $row = $this->_login->getUsuario(
                $this->getAlphaNum('usuario'),
                $this->getSql('pass')
            );

            if (!$row) {
                $this->_view->assign('_error', 'Usuario o contraseña incorrecta');
                $this->_view->renderizar('index', 'login');
                exit;
            }

            if (($row['role'] == 0)) {
                $this->_view->assign('_error', 'El usuario <b>' . $_GET["nickname"] . '</b> no está habilitado');
                $this->_view->renderizar('index', 'login');
                exit;
            }

            Session::set('infousr', $row);
            Session::set('id', $row['id']);
            Session::set('autenticado' . BASE_SESION, true);


            Session::set('base_file_usr' . BASE_SESION, $row['directorio']);
            Session::set('level' . BASE_SESION, $row['role']);

            Session::set('acceso' . BASE_SESION, $accesosRole);
            Session::set('acceso_edit' . BASE_SESION, 0); // ID de acceso de inicio


            Session::set('usuario' . BASE_SESION, $row['usuario']);
            Session::set('nombre' . BASE_SESION, $row['nombre']);
            Session::set('area' . BASE_SESION, $row['fk_area']);
            Session::set('email' . BASE_SESION, $row['email']);
            Session::set('imagen' . BASE_SESION, $row['imagen']);
            Session::set('id_usuario' . BASE_SESION, $row['id']);
            Session::set('UA' . BASE_SESION, $row['ua']);
            Session::set('menu' . BASE_SESION, $this->_acl->get_opciones_menu_principal(1, 1));
            Session::set('tiempo' . BASE_SESION, time());



            $this->redireccionar();
        }


        $this->_view->assign('imgfondo', $imagenFondo);

        $this->_view->renderizar('index', 'login');

    }



    function randomText($length)
    {
        $base = "123456789abcdefghijklmnpqrstuvwxyz";
        for ($i = 0; $i < $length; $i++) {
            $key .= $base[mt_rand(0, 33)];
        }
        return $key;
    }
/*
    public function validao365()
    {
        $LONG_CODE = 16;
        $_SESSION["code_login365"] = $this->randomText($LONG_CODE);

        header("Location:http://login.uqroo.mx/index.php?code=" . $_SESSION["code_login365"] . "&server=" . BASE_URL . "/usuarios/login/ingresao365/");
    }
*/

    public function validao365_2()
    {
        $LONG_CODE = 16;
        $_SESSION["code_login365"] = $this->randomText($LONG_CODE);

        $_SESSION['servidor_origen'] = BASE_URL . "usuarios/login/ingresao365/";

     //   echo "----->".$_SESSION["code_login365"]; exit();

        header("Location:https://sigo.uqroo.mx/login365/index.php?code=" . $_SESSION["code_login365"] . "&server=" . BASE_URL . "usuarios/login/ingresao365/");


    }



    function encrypt($string, $key)
    {
        $result = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));
            $result .= $char;
        }
        return md5(base64_encode($result));
    }




    public function ingresao365()
    {

        //$this->_view->assign('prueba', 'prueba_________________');

        /*
        

        */


       //  if($_GET["code"]!=$this->encrypt($_SESSION["code_login365"],LLAVE_CERTIFICADO)){
        if (false) {

       echo "<pre>";
        print_r($_GET);
        echo "</pre>";

            //$this->redireccionar(); 
            echo "Error en el certificado de seguridad";
            echo "code".$_GET["code"]."<br/>".LLAVE_CERTIFICADO."<br/>";
            echo $_SESSION["code_login365"]."<br/>";
            echo $this->encrypt($_SESSION["code_login365"],LLAVE_CERTIFICADO)."<br/>";

            exit();
        }

        //echo " ---> ".$_GET["nickname"].$_SESSION["code_login365"];

        /*
                 if($_GET["code2"]!=md5($_GET["nickname"].$_SESSION["code_login365"])){
                 echo "Error codificación de correo"; exit();}
                 */







        $partesCorreo = explode("@", $_GET["nickname"]);



        //$row = $this->_login->getUsuarioByUsr( $partesCorreo[0] );
        $row = $this->_login->getUsuarioByUsr($_GET);
        // print_r($row);
        //exit();

        $_SESSION['infousr'] = $row;
        $_SESSION['id'] = $row["id"];
        $_SESSION['getOffice'] = $_GET;

        //Session::set('infousr', $row[0]);

        // $usrid = $_SESSION['infousr']['id']


        /*
        echo "<pre>";
           print_r($row);
        echo "</pre>";
        */

        //  echo "-->".$row['ESTADO'];



        if (!$row) {
            $this->_view->assign('_error', 'El usuario <b>' . $_GET["nickname"] . '</b> no esta habilitado en este sistema. <br/> <a href="http://login.uqroo.mx/fin.php?retorno=' . BASE_URL . '"> Haz clic aquí para cerrar sesión </a> e ingresar con otro usuario.');
            $this->_view->renderizar('index', 'login');
            exit;
        }



        if (($row['ESTADO'] == 0)) {
            $this->_view->assign('_error', 'El usuario <b>' . $_GET["nickname"] . '</b> no está habilitado');
            $this->_view->renderizar('index', 'login');
            exit;
        }


        Session::set('base_file' . BASE_SESION, BASE_FILE);
        Session::set('base_file_real_url' . BASE_SESION, stripslashes(BASE_FILE_URL));

        Session::set('base_file_url' . BASE_SESION, stripslashes(BASE_FILE_URL . $row['directorio']));
        Session::set('base_convert' . BASE_SESION, BASE_CONVERT);



        // $accesosRole = $this->_login->getAccesos($row['role']);
/*
            echo "<pre>";
            print_r($accesosRole);
            echo "</pre>";
*/
        //echo "--->".BASE_SESION; exit();

        Session::set('infousr', $row);

        Session::set('base_file_usr' . BASE_SESION, $row['directorio']);
        Session::set('autenticado' . BASE_SESION, true);
        Session::set('level' . BASE_SESION, $row['role']);

        Session::set('acceso' . BASE_SESION, $accesosRole);
        Session::set('acceso_edit' . BASE_SESION, 0); // ID de acceso de inicio


        Session::set('usuario' . BASE_SESION, $row['usuario']);
        Session::set('nombre' . BASE_SESION, $row['nombre']);
        Session::set('area' . BASE_SESION, $row['fk_area']);
        Session::set('email' . BASE_SESION, $row['email']);
        Session::set('imagen' . BASE_SESION, $row['imagen']);
        Session::set('id_usuario' . BASE_SESION, $row['id']);
        Session::set('UA' . BASE_SESION, $row['ua']);
        Session::set('unidades_administra' . BASE_SESION, $row['unidades_administra']);
        Session::set('menu' . BASE_SESION, $this->_acl->get_opciones_menu_principal(1, 1));
        Session::set('tiempo' . BASE_SESION, time());

        /*
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";
        exit();
        */

        if (isset($_SESSION["url_solicita"]))
            $this->redireccionar($_SESSION["url_solicita"]);
        else
            $this->redireccionar();


    }



    public function cerrar()
    {
        Session::destroy();
        $this->redireccionar();
    }

    public function cerraro365()
    {
        Session::destroy();

        header("Location:http://login.uqroo.mx/fin.php?retorno=" . BASE_URL_SITE);
    }


}

?>