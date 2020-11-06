<?php
	namespace Model;

	class Connection{
		var $query;
		var $link;
		var $result;

       protected $host = "localhost:3308";
       protected $user = "root";
       protected $pass   = "";
       protected $db    = "shareducadb";

		
		function connect(){
			$this->link = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
		}

		function disconnect(){
			mysqli_close($this->link);
		}
		
		function execute($query){
			
			$request = "";

			try{

				$this->connect();
				$this->query = $query;

				$this->result = mysqli_query($this->link,$query);
				if (!empty($this->result)){
					return [True, $this->result];

				}else{
					return [False, "Erro na execução: ".$this->link->error];
				}
				
			}catch(mysqli_sql_exception $e){
				throw $e;//throw new Exception($e);// mysqli_error($this->link);
			}finally{
				$this->disconnect();
			}
		}
	}
?>
