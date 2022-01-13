<?php

	//total de playlists
	$TotalPlaylists = MySql::conectar()->prepare("SELECT * FROM tb_site_playlists WHERE ID > 0");
	$TotalPlaylists->execute();
	$TotalPlaylists = $TotalPlaylists->fetchAll();

    //total de tags
	$TotalConteudos = MySql::conectar()->prepare("SELECT * FROM tb_site_conteudos WHERE ID > 0");
	$TotalConteudos->execute();
	$TotalConteudos = $TotalConteudos->fetchAll();	

?>

<!--exibe total de produtos, tags e categorias-->            
<div class="box-content-home w100"> 

    <div class="descricao-painel">
        <h2><i class="bi bi-house-fill"></i> Gestão de Playlists - <?php echo NOME_EMPRESA ?></h2>
    </div>

    <div class="box-metricas">  
            
        <div class="box-metrica-single"> 
            <div class="box-metrica-wraper">
                <h2>Total Playlists</h2>                
				<p><?php echo count($TotalPlaylists); ?></p>
            </div>                                
        </div>
        
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h2>Total Conteúdos</h2>
                <p><?php echo count($TotalConteudos); ?></p>
            </div>                                
        </div>				

        <div class="clear"></div><!--limpa flutuações-->

    </div>

</div><!--box-content-home-->
