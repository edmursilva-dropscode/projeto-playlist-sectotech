<?php 
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$playlist = Playlist::selecionarPlaylist('tb_site_playlists','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID.');
		die();
	}
 ?>
<div class="box-content-playlist">
	
    <h2><i class="bi bi-ui-checks"></i> Editar Playlist</h2>

	<!--<form class="ajax-form" id="formEditarPlaylist" method="post" enctype="multipart/form-data"> sem este atributo ENCTYPE, nao funciona o upload da imagem-->
	<form id="formEditarPlaylist" method="post" enctype="multipart/form-data"> <!--sem este atributo ENCTYPE, nao funciona o upload da imagem--> 

        <!-- valida envio do formulario adicionar-playlist -->       
		<?php

            //verifica se existe o metodo ACAO, para enviar o formulario adicionar 
			if(isset($_POST['acao'])){
			
                //variaveis de controle
				$titulo = $_POST['titulo'];
				$descricao = $_POST['descricao'];
				$autor = $_POST['autor'];		
			
                //instancia a classe PLAYLIST
                $playlist = new Playlist();
			
                //valida todos os campos do formulario 
				if($titulo == ''){
					Painel::alert('erro','O título está vázio!');
				}else if($descricao == ''){
					Painel::alert('erro','A descricao está vázia!');									
				}else if($autor == ''){
					Painel::alert('erro','O autor está vázio!');
				}else{
					//valida se existe descricao da playlist já cadastrado
					$verifica = MySql::conectar()->prepare("SELECT * FROM tb_site_playlists WHERE title=? AND id != ?");
					$verifica->execute(array($titulo,$id));
					if($verifica->rowCount() == 0){					
						//alterar a playlist no bando de dados  
						if($playlist->alterarPlaylists($id,$titulo,$descricao,$autor)){
							Painel::alert('sucesso','Playlist foi alterada com sucesso!');   
							$playlist = Playlist::selecionarPlaylist('tb_site_playlists','id = ?',array($id));                     	
						}else{
							Painel::alert('erro','Erro ao alterar a playlist!');
						}
					}else{
						Painel::alert('erro','Já existe uma playlist com esse títuloo!');
						$playlist = Playlist::selecionarPlaylist('tb_site_playlists','id = ?',array($id));   
					}						
				} 				
				echo "<meta HTTP-EQUIV='refresh' CONTENT='4'>";
			}
		?>

		<div class="form-group">
			<label>Título:</label>
			<input type="text" name="titulo" maxlength="100" value="<?php echo $playlist['title']; ?>" require>
		</div><!--form-group--> 

		<div class="form-group">
			<label>Descrição:</label>
			<input type="text" name="descricao" maxlength="200" value="<?php echo $playlist['description']; ?>" require>
		</div> 
		
		<div class="form-group">
			<label>Autor:</label>
			<input type="text" name="autor" maxlength="150" value="<?php echo $playlist['author']; ?>" require>
		</div> 

		<div class="form-group">
			<input type="submit" name="acao" value="Atualizar">
			<input type="hidden" name="identificador" value="form_EditarPlaylist">         <!--campos ocultos para servir de referencia-->
            <input type="hidden" name="id" value="<?php echo $playlist['id']; ?>"> 
		</div><!--form-group-->  

	</form>

</div><!--box-content-playlist-->