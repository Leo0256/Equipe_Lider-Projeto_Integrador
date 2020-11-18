<?php
    namespace Controller;

    use Model\Model;
    include_once dirname(__DIR__)."\Model\model.php";

    // Classe responsável por requisitar, mostrar e alterar/adicionar os itens/produtos do sistema.
    Class Item{
        private $model;
        // Local onde são salvos os itens/produtos
        private $folder = "data/";

        public function __construct(){
            $this->model = new Model();
        }

        // Mostra todos os itens de um conteúdo pelo nome ($i).
        public function requestItens($i){
            $content = $this->model->getContent($i);
            $itens = $this->model->getAllItens($content["id"]);
            $message = 0;

            $title = $content["nome"];
            $content = $content["id"];

            $name = "";
            $descrip = "";  $type = "";
            $value = 0.0;   $zise = 0;

            for($x = 0;$x < count($itens);$x++){
                $name = utf8_encode($itens[$x]["nome"]);
                $type = utf8_encode($itens[$x]["tipo"]);
                $zise = $itens[$x]["tamanho"];
                $descrip = utf8_encode($itens[$x]["descrip"]);
                $value = $itens[$x]["valor"];

                require dirname(__DIR__)."/View/Cards/List_Item_card.php";
            }
        }

        // Mostra todos os conteúdos.
        public function requestContents(){
            $contents = $this->model->getAllContent();
            $id = 0;        $name = "";
            $descrip = "";  $img = "logo.jpg"; 

            foreach ($contents as $key => $value) {
                $id = $value["id"];
                $name = utf8_encode($value["nome"]);
                $descrip = utf8_encode($value["descrip"]);
                $img = utf8_encode($value["img"]);

                require dirname(__DIR__)."/View/Cards/Conteudos_card.php";
            }
        }

        // Retorna o arquivo solicitado pelo nome ($i).
        public function requestFile($i){
            $get_file = $this->model->getItem($i);
            $get_file["conteudo"] = utf8_encode($this->model->getContent((int)$get_file["conteudo"])["nome"]);
            $get_file["descrip"] = utf8_encode($get_file["descrip"]);

            return $get_file;
        }

        // Registra e adiciona um novo item/produto ao sistema.
        public function newItem(){
            $file = [
                'file' => '',
                'size' => 0,
                'type' => '',
                'descrip' => '',
                'content' => 0,
                'value' => 0.0
            ];
            if(isset($_POST['upload'])){
                if (isset($_FILES['file']['tmp_name']) && !empty($_FILES['file']['tmp_name']))
                #$file['name'] = rand(1000,100000)."-".$_FILES['file']['name'];
                $file['name'] = utf8_decode($_FILES['file']['name']);

                // Estes dados são obtidos junto do arquivo selecionado.
                $file['file'] = $_FILES['file']['tmp_name'];
                $file['size'] = $_FILES['file']['size'];
                $file['type'] = $_FILES['file']['type'];

                // Verifica se o dados informado $_POST está vazio antes de ser registrado.
                // Caso o campo informado estiver vazio, ele receberá um valor pré definido.
                if(isset($_POST['descrip']) && !empty($_POST['descrip'])){
                    $file['descrip'] = utf8_decode(utf8_encode(trim($_POST['descrip'])));
                }

                if(isset($_POST['content']) && !empty($_POST['content'])){
                    $file['content'] = $this->model->getContent(utf8_decode($_POST['content']))["id"];
                }
                
                if (isset($_POST['value']) && !empty($_POST['value'])){
                    $file['value'] = str_replace(",",".",$_POST['value']);
                }

                $response = $this->model->saveData($file);
                if($response){
                    move_uploaded_file($file['file'],$this->folder.$file['name']);
                }
            }
        }

        // Gera os dados necessários para o 'carrosel' dos conteúdos.
        public function generateCarousel(){
            $content = $this->model->getAllContent();

            $count = count($content);
            $name = $descrip = $img = [];

            for($x=0;$x<$count;$x++){
                $name[$x] = utf8_encode($content[$x]["nome"]);
                $descrip[$x] = utf8_encode($content[$x]["descrip"]);
                $img[$x] = $content[$x]["img"];
            }

            $data = [
                'count' => $count,
                'name' => $name,
                'descrip' => $descrip,
                'img' => $img
            ];

            return $data;
        }


    }
?>