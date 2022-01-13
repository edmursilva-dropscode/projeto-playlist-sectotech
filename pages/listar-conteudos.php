<?php

	//valida acai excluir 
	if(isset($_GET['excluir'])){
		//seleciona o conteudo pelo ID
		$idExcluir = intval($_GET['excluir']);
		//busca informacao do conteudo 
		$conteudo = Conteudo::selecionarConteudo('tb_site_conteudos','id = ?',array($idExcluir));
		//DELETA CONTEUDO
		Conteudo::deletarConteudo('tb_site_conteudos',$idExcluir);
		//redireciona a url do site para listar-conteudos  
		Painel::redirect(INCLUDE_PATH_PAINEL.'listar-conteudos');
	}else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('tb_site_conteudos',$_GET['order'],$_GET['id']);		
	}

	//valida pagina de exibicao
	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1; 
	$porPagina = 10;

	$conteudosPainel = painel::selectAllOrderId('tb_site_conteudos',($paginaAtual - 1) * $porPagina,$porPagina);
	
?>
<div class="box-content-listar-conteudos">
	
    <h2><i class="bi bi-inboxes-fill"></i> Conteudos Cadastrados</h2> 

	<div class="wraper-table">
		<table>
			<tr>
				<td>Playlist</td>
				<td>Título</td>
				<td>Url</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>				
			</tr>

			<?php
				//lista todos registros da variavel $conteudosPainel   
				foreach ($conteudosPainel as $key => $value) {
				$descricaoPlaylist = Painel::select('tb_site_playlists','id=?',array($value['playlist_id']))['description'];
			?>			
				<tr>
					<td><?php echo strlen($descricaoPlaylist)>=40 ? substr($descricaoPlaylist,0,40).'...' : $descricaoPlaylist; ?></td>
					<td><?php echo strlen($value['title'])>=40 ? substr($value['title'],0,40).'...' : $value['title']; ?></td>
					<td><?php echo strlen($value['urldescricao'])>=40 ? substr($value['urldescricao'],0,40).'...' : $value['urldescricao']; ?></td>
					<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-conteudos?id=<?php echo $value['id']; ?>"><i class="bi bi-pencil-square"></i> Editar</a></td>
					<td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-conteudos?excluir=<?php echo $value['id']; ?>"><i class="bi bi-trash-fill"></i> Excluir</a></td>
					<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-conteudos?order=up&id=<?php echo $value['id'] ?>"><i class="bi bi-caret-up-square-fill"></i></a></td>
					<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-conteudos?order=down&id=<?php echo $value['id'] ?>"><i class="bi bi-caret-down-square-fill"></i></a></td>
				</tr>        
			<?php } ?>

		</table>
	</div>

	<div class="paginacao">
		<?php
			$totalPaginas = ceil(count(Painel::selectAllOrderId('tb_site_conteudos')) / $porPagina);

			for($i = 1; $i <= $totalPaginas; $i++){
				if($i == $paginaAtual)
					echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-conteudos?pagina='.$i.'">'.$i.'</a>';
				else
					echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-conteudos?pagina='.$i.'">'.$i.'</a>';
			}

		?>
	</div><!--paginacao-->	

</div><!--box-content-listar-conteudos-->  