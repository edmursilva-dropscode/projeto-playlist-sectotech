<?php
	
	class Playlist 
	{
			
		//cadastra nova playlist  
		public static function cadastrarPlaylists($titulo,$descricao,$autor){ 
			//total de playlists na base
			$TotalPlaylists = MySql::conectar()->prepare("SELECT Count(*) + 1 AS total FROM tb_site_playlists");
			$TotalPlaylists->execute();
			if($TotalPlaylists->rowCount() == 1){
				$info = $TotalPlaylists->fetch();
				//dados da base
				$total = $info['total'];                 
			}else{
				$info = $TotalPlaylists->fetch();
				//dados da base
				$total = '1'; 
			} 
			//					
			$datehora = date('Y-m-d H:i:s');
			//		
			$sql = MySql::conectar()->prepare("INSERT INTO tb_site_playlists VALUES (null,?,?,?,?,?,?)");
			if($sql->execute(array($titulo,$descricao,$autor,$total,$datehora,$datehora))){ 
				return true;
			}else{
				return false;
			}
		}

		//altera a playlist da lista atraves do campo ID  
		public static function alterarPlaylists($id,$titulo,$descricao,$autor){	
			//					
			$datehora = date('Y-m-d H:i:s');
			//								
			$query = "UPDATE tb_site_playlists SET title = '{$titulo}', description = '{$descricao}', author = '{$autor}', updated_at = '{$datehora}'";			
			$sql = MySql::conectar()->prepare($query.' WHERE id=?');
			if($sql->execute(array($id))){ 
				return true;
			}else{
				return false;
			}			
		} 

		//deleta a playlist da lista atraves do campo ID 
		public static function deletarPlaylist($tabela,$id=false){
			if($id == false){
				$sql = MySql::conectar()->prepare("DELETE FROM $tabela");
			}else{
				$sql = MySql::conectar()->prepare("DELETE FROM $tabela WHERE id = $id");
			}
			$sql->execute();
		}			

		//metodo especifico para selecionar apenas 1 registro da tabela 
		public static function selecionarPlaylist($table,$query,$arr){
			$sql = MySql::conectar()->prepare("SELECT * FROM $table WHERE $query");
			$sql->execute($arr);
			return $sql->fetch();
		}		

	} 

?>