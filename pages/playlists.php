<div class="box-content-playlist">
	
    <h2><i class="bi bi-ui-checks"></i> Adicionar Playlists</h2>

	<!-- <form class="ajax-form" id="formPlaylist" method="post" enctype="multipart/form-data"> sem este atributo ENCTYPE, nao funciona o upload da imagem-->
	<form id="formPlaylist" method="post" enctype="multipart/form-data"> <!--sem este atributo ENCTYPE, nao funciona o upload da imagem--> 

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
					$verifica = MySql::conectar()->prepare("SELECT * FROM tb_site_playlists WHERE title=?");
					$verifica->execute(array($titulo));
					if($verifica->rowCount() == 0){					
						//cadastrar a playlist no bando de dados  
						if($playlist->cadastrarPlaylists($titulo,$descricao,$autor)){
							Painel::alert('sucesso','O cadastro da playlist foi feito com sucesso!');                        	
						}else{
							Painel::alert('erro','Erro ao cadastrar a playlist!');
						}
					}else{
						Painel::alert('erro','Já existe uma playlist com esse título!');
					}
				} 				
				echo "<meta HTTP-EQUIV='refresh' CONTENT='4'>";
			}
		?>

		<div class="form-group">
			<label>Título:</label>
			<input type="text" name="titulo" maxlength="100" require>
		</div><!--form-group--> 

		<div class="form-group">
			<label>Descrição:</label>
			<input type="text" name="descricao" maxlength="200" require>
		</div> 
		
		<div class="form-group">
			<label>Autor:</label>
			<input type="text" name="autor" maxlength="150" require>
		</div> 	  

		<div class="form-group">
			<input type="hidden" name="identificador" value="form_Playlist">         <!--campos ocultos para servir de referencia-->
			<input type="submit" name="acao" value="Cadastrar">
		</div>

	</form>

</div><!--box-content-playlist-->