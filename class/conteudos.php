<?php
	
	class Conteudo 
	{      			

		//cadastra novo conteudo
		public static function cadastrarConteudos($playlist_id,$titulo,$urldescricao,$author){
			//total de conteudos na base
			 $TotalConteudos = MySql::conectar()->prepare("SELECT Count(*) + 1 AS total FROM tb_site_conteudos");
			 $TotalConteudos->execute();
			if($TotalConteudos->rowCount() == 1){
				$info = $TotalConteudos->fetch();
				//dados da base
				$total = $info['total'];                 
			}else{
				$info = $TotalConteudos->fetch();
				//dados da base
				$total = '1'; 
			} 
			//					
			$datehora = date('Y-m-d H:i:s');
			//			
			$sql = MySql::conectar()->prepare("INSERT INTO tb_site_conteudos VALUES (null,?,?,?,?,?,?)");
			if($sql->execute(array($playlist_id,$titulo,$urldescricao,$author,$total,$datehora))){ 
				return true;
			}else{
				return false;
			} 
		}

		//altera o conteudo da lista atraves do campo ID  
		public static function alterarConteudos($id,$playlist_id,$titulo,$urldescricao,$author){	
			//					
			$datehora = date('Y-m-d H:i:s');
			//					
			$query = "UPDATE tb_site_conteudos SET playlist_id = '{$playlist_id}', title = '{$titulo}', urldescricao = '{$urldescricao}', author = '{$author}', updated_at = '{$datehora}'";			
			$sql = MySql::conectar()->prepare($query.' WHERE id=?');
			if($sql->execute(array($id))){ 
				return true;
			}else{
				return false;
			}			
		} 

		//deleta o conteudo da lista atraves do campo ID  
		public static function deletarConteudo($tabela,$id=false){
			if($id == false){
				$sql = MySql::conectar()->prepare("DELETE FROM $tabela");
			}else{
				$sql = MySql::conectar()->prepare("DELETE FROM $tabela WHERE id = $id");
			}
			$sql->execute();
		}			

		//metodo especifico para selecionar apenas 1 registro da tabela 
		public static function selecionarConteudo($table,$query,$arr){
			$sql = MySql::conectar()->prepare("SELECT * FROM $table WHERE $query");
			$sql->execute($arr);
			return $sql->fetch();
		}				

	} 

?>