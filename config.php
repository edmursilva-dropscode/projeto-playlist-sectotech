<?php 

    //configuracao do banco de dados       
    include('class/mysql.php');   
	//configuracao do site
	include('class/painel.php');  
	include('class/usuarios.php'); 
	include('class/playlists.php'); 	
	include('class/conteudos.php'); 	
	
	//trabalhando com sessao para armazenagem de dados   
	session_start(); 
	//trabalhando com data e hora de são paulo atual
	date_default_timezone_set('America/Sao_Paulo');      
    
    //define o caminho padrao do site para as contantes
    define('INCLUDE_PATH','http://localhost/SectoTech_Playist/');
	define('INCLUDE_PATH_PAINEL',INCLUDE_PATH); 

	//define o caminho padrao do diretorio /INDEX no site 
	define('BASE_DIR_PATH',__DIR__);

	//Conectar com banco de dados
	define('HOST','localhost');
	define('USER','root');
	define('PASSWORD','');
	define('DATABASE','sectotechplaylist');	

	//variavel/contante da empresa desenvolvedora do site
	define('NOME_EMPRESA','SECTOTECH');

	//Funções do painel
	function selecionadoMenu($par){		
		$url = explode('/',@$_GET['url'])[0];
		if($url == $par){
			echo 'class="menu-active"';
		}
	}
    
	function verificaPermissaoMenu($permissao){

		if($_SESSION['id_perfil'] == '1'){
			if (mb_strpos('1 2', $permissao) !== false) {
				return;
			}else{
				echo 'style="display:none;"';
			}
		}else if($_SESSION['id_perfil'] == '2'){
			if (mb_strpos('2', $permissao) !== false) {
				return;
			}else{
				echo 'style="display:none;"';
			}
		}
	}

	function recoverPost($post){
		if(isset($_POST[$post])){
			echo $_POST[$post];
		}
	}

?> 