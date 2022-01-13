<div class="box-content-conteudo">
	
    <h2><i class="bi bi-inboxes-fill"></i> Adicionar conteúdos</h2>

	<!--<form class="ajax-form" id="formConteudo" method="post" enctype="multipart/form-data"> sem este atributo ENCTYPE, nao funciona o upload da imagem-->
	<form id="formConteudo" method="post" enctype="multipart/form-data"> <!--sem este atributo ENCTYPE, nao funciona o upload da imagem--> 

        <!-- valida envio do formulario adicionar-conteudo -->        
		<?php

            //verifica se existe o metodo ACAO, para enviar o formulario adicionar       
			if(isset($_POST['acao'])){
			
                //variaveis de controle
				$playlist_id = $_POST['playlist_id'];
				$titulo = $_POST['titulo'];				
				$urldescricao = $_POST['urldescricao'];
				$author = $_POST['author'];
			
                //instancia a classe CONTEUDO   
                $conteudo = new Conteudo();
			
                //valida todos os campos do formulario    
				if($titulo == ''){
					Painel::alert('erro','O título está vázia!');
                }else if($playlist_id == ''){
					Painel::alert('erro','A playlist não está selecionada!');
                }else if($urldescricao == ''){
					Painel::alert('erro','A url está vázia!');				
				}else if($author == ''){
					Painel::alert('erro','O author está vázio!');
				}else{
					//valida se existe titulo do conteudo já cadastrado  
					$verifica = MySql::conectar()->prepare("SELECT * FROM tb_site_conteudos WHERE title=? AND playlist_id = ?");
					$verifica->execute(array($titulo,$playlist_id));
					if($verifica->rowCount() == 0){
						//cadastrar o conteudo no bando de dados 						
						if($conteudo->cadastrarConteudos($playlist_id,$titulo,$urldescricao,$author)){								
							Painel::alert('sucesso','O cadastro do conteudo foi feito com sucesso!');  							                     	
						}else{
							Painel::alert('erro','Erro ao cadastrar o conteudo!');
						}
					}else{
						Painel::alert('erro','Já existe um conteudo com esse titulo!');
					}							
				} 	
				echo "<meta HTTP-EQUIV='refresh' CONTENT='4'>";								
			}						
		?>

        <div class="form-group"> 
            <label>Playlist:</label>
            <select name="playlist_id">
				<option value="">Seleciona um item</option> 
                <?php
                    $playlist = Painel::selectAll('tb_site_playlists');
                    foreach ($playlist as $key => $value) {
                ?>
                <option <?php if($value['id'] == @$_POST['playlist_id']) echo 'selected'; ?> value="<?php echo $value['id'] ?>"><?php echo $value['description']; ?></option>
                <?php } ?>
            </select>
		</div>

		<div class="form-group">
			<label>Título:</label>
			<input type="text" name="titulo" maxlength="150" require>
		</div><!--form-group--> 

		<div class="form-group">
			<label>Url:</label>
			<input type="text" name="urldescricao" maxlength="255" require>
		</div> 
		
		<div class="form-group">
			<label>Autor:</label>
			<input type="text" name="author" maxlength="150" require>
		</div> 	

		<div class="form-group">
			<input type="hidden" name="identificador" value="form_Conteudo">         <!--campos ocultos para servir de referencia-->
			<input type="submit" name="acao" value="Cadastrar">
		</div><!--form-group-->  

	</form>

</div><!--box-content-conteudo-->