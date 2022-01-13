<?php

	//valida acao excluir 
	if(isset($_GET['excluir'])){
		//seleciona a playlist pelo ID
		$idExcluir = intval($_GET['excluir']);
		//busca informacao da playlist
		$playlist = Playlist::selecionarPlaylist('tb_site_playlists','id = ?',array($idExcluir));
		//DELETA PLAYLISTS
		Playlist::deletarPlaylist('tb_site_playlists',$idExcluir);
		//redireciona a url do site para listar-playlists  
		Painel::redirect(INCLUDE_PATH_PAINEL.'listar-playlists');		
	}else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('tb_site_playlists',$_GET['order'],$_GET['id']);		
	}

	//valida pagina de exibicao
	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1; 
	$porPagina = 10;

	$playlistsPainel = painel::selectAllOrderId('tb_site_playlists',($paginaAtual - 1) * $porPagina,$porPagina);
	
?>
<div class="box-content-listar-playlists">
	
    <h2><i class="bi bi-ui-checks"></i> Playlists Cadastradas</h2> 

	<div class="wraper-table">
		<table>
			<tr>
				<td>Título</td>
				<td>Descrição</td>
				<td>Autor</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>				
			</tr>

			<?php
				//lista todos registros da variavel $playlistsPainel  
				foreach ($playlistsPainel as $key => $value) {
			?>			
				<tr>
					<td><?php echo strlen($value['title'])>=40 ? substr($value['title'],0,40).'...' : $value['title']; ?></td>
					<td><?php echo strlen($value['description'])>=40 ? substr($value['description'],0,40).'...' : $value['description']; ?></td>
					<td><?php echo strlen($value['author'])>=40 ? substr($value['author'],0,40).'...' : $value['author']; ?></td>
					<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-playlists?id=<?php echo $value['id']; ?>"><i class="bi bi-pencil-square"></i> Editar</a></td>
					<td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-playlists?excluir=<?php echo $value['id']; ?>"><i class="bi bi-trash-fill"></i> Excluir</a></td>
					<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-playlists?order=up&id=<?php echo $value['id'] ?>"><i class="bi bi-caret-up-square-fill"></i></a></td>
					<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-playlists?order=down&id=<?php echo $value['id'] ?>"><i class="bi bi-caret-down-square-fill"></i></a></td>
				</tr>        
			<?php } ?>

		</table>
	</div>

	<div class="paginacao">
		<?php
			$totalPaginas = ceil(count(Painel::selectAllOrderId('tb_site_playlists')) / $porPagina);

			for($i = 1; $i <= $totalPaginas; $i++){
				if($i == $paginaAtual)
					echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-playlists?pagina='.$i.'">'.$i.'</a>';
				else
					echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-playlists?pagina='.$i.'">'.$i.'</a>';
			}

		?>
	</div><!--paginacao-->	

</div><!--box-content-listar-playlists--> 