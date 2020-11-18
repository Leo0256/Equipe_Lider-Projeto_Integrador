<?php
    namespace Controller;

    use Model\Model;
    include_once dirname(__DIR__)."\Model\model.php";
    
    // Classe responsável pelo gerenciamento das contas de usuário.
    class AccountManager{
        private $model;
        private $user;

        public function __construct(){
            $this->model = new Model();

            $this->user = $_SESSION["user"];
        }

        // Realiza o Log in do cliente.
        public function makeLogin(){
            if(isset($_POST["submit_login"])){
                $var = [
                    "nome" => $_POST["nome"],
                    "email" => $_POST["email"],
                    "senha" => hash(hash_algos()[rand(0,count(hash_algos()))],trim($_POST["senha"]))
                ];

                $response = $this->model->setUser($var);
                if($response[0]){
                    $_SESSION["user"] = $this->model->getUser($var["email"])[1]->fetch_assoc();
                }
            }
        }

        // Realiza o Log on do clente.
        public function makeLogon(){
            if(isset($_POST["submit_logon"])){
                $hash = "";
                $user = $this->model->getUser($_POST["user"]);
                
                if($user != False){
                    for($x = 0;$x<count(hash_algos());$x++){
                        $hash = hash(hash_algos()[$x],trim($_POST["senha"]));
                       
                        if(($hash == $user["senha"]) == True){
                            $_SESSION["user"] = $user;
                            return "Bem-Vindo ".$user["nome"]."!";
                        }
                    }
                    if($resp == null){
                        return "Senha Incorreta";
                    }

                }else{
                    return "Usuario desconhecidos";
                }
            }

            return null;
        }

        private function finishSession(){
            session_destroy();
        }

    }
?>