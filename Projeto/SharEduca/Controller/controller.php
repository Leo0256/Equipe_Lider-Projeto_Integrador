<?php
    namespace Controller;

    use Model\Model, Controller\AccountManager, Controller\Item;

    include_once dirname(__DIR__)."\Model\model.php";
    include_once dirname(__DIR__)."\Controller\acc_controller.php";
    include_once dirname(__DIR__)."\Controller\itens_controller.php";

    // Classe central de controle, responsável por conectar todos os métodos e funções com 
    Class Controller{
        private $model;
        private $user;
        private $account;
        private $item;
        private $acc_status;
        public $resp = "";

        public function __construct($local){
            // temporário
            $this->model = new Model();
            //
            $this->account = new AccountManager();
            $this->item = new Item();

            $this->settings();

            $paste = ($local != "" ?
                dirname(__DIR__)."/View/".$local.".php" : ""
            );

            if(file_exists($paste)){
                require $paste;
            }else{
                require dirname(__DIR__)."/View/error/404.php";
            }

            if(isset($_GET["con"])){
                $var = explode(",",$_GET["con"]);
                $this->{$var[0]}($var[1]);
            }
        }

        private function settings(){
            if(isset($_POST["submit_login"])){
                $this->login();
            }else if(isset($_POST["submit_logon"])){
                $this->logon();
            }

            $this->user = (isset($_SESSION["user"]) ?
                $_SESSION["user"] : ""
            );

            $this->acc_status = (is_array($this->user) ?
                "Conta" : "Login"                
            );
        }

        // Mostra todos os conteúdos
        public function showContents(){
            $this->item->requestContents();
        }

        // Mostra todos os itens de um conteúdo
        public function showItens($i){
            $this->item->requestItens($i);
        }

        // Retorna o arquivo solicitado pelo nome ($i).
        public function showFile($i){
            return $this->item->requestFile($i);
        }


        // Registra e adiciona um novo item/produto ao sistema.
        public function addItem(){
            $this->item->newItem();
        }

        // Gera os dados necessários para o 'carrosel' dos conteúdos.
        public function carousel(){
            return $this->item->generateCarousel();
        }


        // Realiza o Log in do cliente.
        private function login(){
            $this->account->makeLogin();
        }
        // Realiza o Log on do clente.
        private function logon(){
            $this->resp = $this->account->makeLogon();
        }


        /* ------ testes ------ */
        
        // Adiciona o item informado
        public function add($item){
            //
            $cart = 1;
            //
            $this->resp = $this->model->addItemCart($cart, $item);
        }

        /*
        public function cart(){
            $response = "";
            if(isset($_POST['button'])){
                $cart = $_POST['cart'];
                $item = $_POST['item'];
                if($_POST['button'] == "Enviar"){
                    $response = $this->model->setCart($cart, $item);
                }else if($_POST['Limpar']){
                    $response = $this->model->cleanCart($cart);
                }else{
                    $response = $this->model->delCartItem($cart, $item);
                }
            }
        }
        */
    }
?>