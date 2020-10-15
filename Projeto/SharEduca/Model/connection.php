<?php

	class Connection{
		var $query;
		var $link;
		var $result;

       protected $host = "localhost:3308";
       protected $user = "root";
       protected $pass   = "";
       protected $db    = "shareduca";

		
		function connect(){
			$this->link = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
		}

		function disconnect(){
			mysqli_close($this->link);
		}
		
		function executeQuery($query){
			
			$request = "";

			try{

				$this->connect();
				$this->query = $query;

				if($this->result = mysqli_query($this->link,$query)){
					$request = $this->result;

					return $request;
				}
				
			}catch(mysqli_sql_exception $e){
				throw $e;//throw new Exception($e);// mysqli_error($this->link);
			}finally{
				$this->disconnect();
			}
		}
	}
?>
