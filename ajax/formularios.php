<?php 
    //valida e configura envio das informacoes para o email ou banco de dados  

    //verifica se arquivo existe 
    if(file_exists('../config.php'))
    {
        //configuracao de classificacao instanciar as classes 
        include('../config.php');

        //valida identificador form 
        if($_POST['identificador'] == 'form_FormularioLogin'){ 

            //echo '<script>alert("Aki 2...")</script>';
        
            //percorre array para guardar sucesso ou erro 
            $data = array('sucesso'=>true,'mensagem'=>'Informações validada com sucesso!');

            //variaveis de controle
            $user = $_POST['user'];
            $password = $_POST['password'];

            //valida od campos chavesdos os campos do formulario
            if($user != filter_var($user, FILTER_VALIDATE_EMAIL)){
                $data = array('sucesso'=>false,'mensagem'=>'Email digitado está incorreto!');
            }else if($password == ''){
                $data = array('sucesso'=>false,'mensagem'=>'A senha está vázia!');                   
            }
        
            //enviar formulario
            if($data['sucesso']){            

                //valida banco de dados 
                $sql = MySql::conectar()->prepare("SELECT * FROM tb_admin_usuarios WHERE usuario = ? AND senha = ?");
                $sql->execute(array($user,$password));
                if($sql->rowCount() == 1){
                    $info = $sql->fetch();
                    //Logamos com sucesso.
                    $_SESSION['login'] = true;
                    $_SESSION['usuaio'] = $user;
                    $_SESSION['senha'] = $password;
                    $_SESSION['id_perfil'] = $info['id_perfil'];
                    $_SESSION['nome'] = $info['nome']; 
                    $_SESSION['img'] = $info['img'];
                    $_SESSION['id_Usuario'] = $info['id'];
                    ////
                    //header('Location: '.INCLUDE_PATH_PAINEL);
                    ////
                    //die();    
                    $data = array('sucesso'=>true,'mensagem'=>'Informações enviada com sucesso!');                
                }else{
                    //
                    $data = array('sucesso'=>false,'mensagem'=>'Erro ao tentar enviar informações!'); 
                }

            }

            //encerra o processo returnando SUCESSO ou ERRO 
            die(json_encode($data));  
        
        //valida identificador form 
        }else if($_POST['identificador'] == 'form_EditarConteudo'){
                    
            //percorre array para guardar sucesso ou erro
            $data = array('sucesso'=>true,'mensagem'=>'Informações validada com sucesso!');

            //variaveis de controle
            $id = $_POST['id'];
            $playlist_id = $_POST['playlist_id'];
            $titulo = $_POST['titulo'];				
            $urldescricao = $_POST['urldescricao'];
            $author = $_POST['author'];

            //instancia a classe CONTEUDO
            $conteudo = new Conteudo();

            //valida todos os campos do formulario    
            if($titulo == ''){
                $data = array('sucesso'=>false,'mensagem'=>'O título está vázia!');
            }else if($playlist_id == ''){
                $data = array('sucesso'=>false,'mensagem'=>'A playlist não está selecionada!');
            }else if($urldescricao == ''){
                $data = array('sucesso'=>false,'mensagem'=>'A url está vázia!');
            }else if($author == ''){
                $data = array('sucesso'=>false,'mensagem'=>'O author está vázio!');
            }else{
                //valida se existe titulo do conteudo já cadastrado   
                $verifica = MySql::conectar()->prepare("SELECT * FROM tb_site_conteudos WHERE title=? AND playlist_id != ?");
                $verifica->execute(array($titulo,$playlist_id));
                if($verifica->rowCount() == 0){
                    //cadastrar o conteudo no bando de dados 						
                    if($conteudo->alterarConteudos($id,$playlist_id,$titulo,$urldescricao,$author)){								
                        $data = array('sucesso'=>true,'mensagem'=>'Conteúdo foi alterada com sucesso!');
                        $conteudo = Conteudo::selecionarConteudo('tb_site_conteudos','id = ?',array($id));   							                     	
                    }else{
                        $data = array('sucesso'=>false,'mensagem'=>'Erro ao alterar o conteudo!');
                    }
                }else{
                    $data = array('sucesso'=>false,'mensagem'=>'Já existe um conteudo com esse titulo!');
                    $conteudo = conteudo::selecionarConteudo('tb_site_conteudos','id = ?',array($id));   
                }							
            } 				            

            //encerra o processo returnando SUCESSO ou ERRO
            die(json_encode($data));  

        //valida identificador form 
        }else if($_POST['identificador'] == 'form_Conteudo'){
                
            //percorre array para guardar sucesso ou erro
            $data = array('sucesso'=>true,'mensagem'=>'Informações validada com sucesso!');

            //variaveis de controle
            $playlist_id = $_POST['playlist_id'];
            $titulo = $_POST['titulo'];				
            $urldescricao = $_POST['urldescricao'];
            $author = $_POST['author'];

            //instancia a classe CONTEUDO
            $conteudo = new Conteudo();

            //valida todos os campos do formulario
            if($titulo == ''){
                $data = array('sucesso'=>false,'mensagem'=>'O título está vázia!');
            }else if($playlist_id == ''){
                $data = array('sucesso'=>false,'mensagem'=>'A playlist não está selecionada!');
            }else if($urldescricao == ''){
                $data = array('sucesso'=>false,'mensagem'=>'A url está vázia!');
            }else if($author == ''){
                $data = array('sucesso'=>false,'mensagem'=>'O author está vázio!');
            }

            //enviar formulario
            if($data['sucesso']){
                //valida se existe titulo do conteúdo já cadastrado
                $verifica = MySql::conectar()->prepare("SELECT * FROM tb_site_conteudos WHERE title=? AND playlist_id != ?");
                $verifica->execute(array($titulo,$playlist_id));
                if($verifica->rowCount() == 0){					
                    //cadastrar o conteudo no bando de dados  
                    if($conteudo->cadastrarConteudos($playlist_id,$titulo,$urldescricao,$author)){		
                        $data = array('sucesso'=>true,'mensagem'=>'O cadastro do conteúdo foi feito com sucesso!');
                    }else{
                        $data = array('sucesso'=>false,'mensagem'=>'Erro ao cadastrar o conteúdo!');
                    }
                }else{
                    $data = array('sucesso'=>false,'mensagem'=>'Já existe um conteúdo com esse título!');
                }
            } 				            

            //encerra o processo returnando SUCESSO ou ERRO
            die(json_encode($data));  

        //valida identificador form 
        }else if($_POST['identificador'] == 'form_EditarPlaylist'){
            
            //percorre array para guardar sucesso ou erro
            $data = array('sucesso'=>true,'mensagem'=>'Informações validada com sucesso!');

            //variaveis de controle
            $id = $_POST['id'];
            $titulo = $_POST['titulo'];
            $descricao = $_POST['descricao'];
            $autor = $_POST['autor'];

            //instancia a classe PLAYLIST
            $playlist = new Playlist();

            //valida todos os campos do formulario
            if($titulo == ''){
                $data = array('sucesso'=>false,'mensagem'=>'O título está vázio!');
            }else if($descricao == ''){
                $data = array('sucesso'=>false,'mensagem'=>'A descricao está vázia!');
            }else if($autor == ''){
                $data = array('sucesso'=>false,'mensagem'=>'O autor está vázio!');
            }

            //enviar formulario
            if($data['sucesso']){

                //valida se existe descricao da playlist já cadastrado
                $verifica = MySql::conectar()->prepare("SELECT * FROM tb_site_playlists WHERE title=? AND id != ?");
                $verifica->execute(array($titulo,$id));                
                if($verifica->rowCount() == 0){					
                    //cadastrar a playlist no bando de dados  
                    if($playlist->alterarPlaylist($id,$titulo,$descricao,$autor)){
                        $data = array('sucesso'=>true,'mensagem'=>'Playlist foi alterada com sucesso!');
                        $playlist = Playlist::selecionarPlaylist('tb_site_playlists','id = ?',array($id));  
                    }else{
                        $data = array('sucesso'=>false,'mensagem'=>'Erro ao alterar a playlist!');
                    }
                }else{
                    $data = array('sucesso'=>false,'mensagem'=>'Já existe uma playlist com esse título!');
                    $playlist = Playlist::selecionarPlaylist('tb_site_playlists','id = ?',array($id)); 
                }
            } 				            

            //encerra o processo returnando SUCESSO ou ERRO 
            die(json_encode($data));  

        //valida identificador form 
        }else if($_POST['identificador'] == 'form_Playlist'){
        
            //percorre array para guardar sucesso ou erro
            $data = array('sucesso'=>true,'mensagem'=>'Informações validada com sucesso!');

            //variaveis de controle
            $titulo = $_POST['titulo'];
            $descricao = $_POST['descricao'];
            $autor = $_POST['autor'];

            //instancia a classe PLAYLIST
            $playlist = new Playlist();

            //valida todos os campos do formulario
            if($titulo == ''){
                $data = array('sucesso'=>false,'mensagem'=>'O título está vázio!');
            }else if($descricao == ''){
                $data = array('sucesso'=>false,'mensagem'=>'A descricao está vázia!');
            }else if($autor == ''){
                $data = array('sucesso'=>false,'mensagem'=>'O autor está vázio!');
            }

            //enviar formulario
            if($data['sucesso']){
                //valida se existe descricao da playlist já cadastrado
                $verifica = MySql::conectar()->prepare("SELECT * FROM tb_site_playlists WHERE title=?");
                $verifica->execute(array($titulo));
                if($verifica->rowCount() == 0){					
                    //cadastrar a playlist no bando de dados  
                    if($playlist->cadastrarPlaylists($titulo,$descricao,$autor)){
                        $data = array('sucesso'=>true,'mensagem'=>'O cadastro da playlist foi feito com sucesso!');
                    }else{
                        $data = array('sucesso'=>false,'mensagem'=>'Erro ao cadastrar a playlist!');
                    }
                }else{
                    $data = array('sucesso'=>false,'mensagem'=>'Já existe uma playlist com esse título!');
                }
            } 				            

            //encerra o processo returnando SUCESSO ou ERRO
            die(json_encode($data));  

        //valida identificador form 
        }else if($_POST['identificador'] == 'form_EditarUsuario'){
        
            //percorre array para guardar sucesso ou erro
            $data = array('sucesso'=>true,'mensagem'=>'Informações validada com sucesso!');

            //variaveis de controle
            $id = $_POST['id'];
            $login = $_POST['usuario'];
            $nome = $_POST['nome'];
            $senha = $_POST['password'];
            $validarSenha = $_POST['valid-password'];
            $imagemAtualizada = $_FILES['imagemAtualizada'];
            $fotoUsuario = $_POST['imagemUsuario'];				
            $id_perfil = $_POST['id_perfil'];

            //instancia a classe USUARIO   
            $adminUsuarios = new AdminUsuarios();            

            //valida od campos chavesdos os campos do formulario
            if($login == ''){
                $data = array('sucesso'=>false,'mensagem'=>'O login está vázio!');
            }else if($login != filter_var($login, FILTER_VALIDATE_EMAIL)){
                $data = array('sucesso'=>false,'mensagem'=>'Email digitado está incorreto!');                   
            }else if($nome == ''){
                $data = array('sucesso'=>false,'mensagem'=>'O nome está vázio!');                   
            }else if($senha == ''){
                $data = array('sucesso'=>false,'mensagem'=>'A senha está vázia!');                  
            }else if($id_perfil == ''){
                $data = array('sucesso'=>false,'mensagem'=>'O perfil precisa estar selecionado!');                   
            }else if($fotoUsuario['name'] == ''){
                $data = array('sucesso'=>false,'A imagem precisa estar selecionada!');
            }else if($senha != $validarSenha){
                $data = array('sucesso'=>false,'Senhas diferentes, favor tende novamente!');
            }else if(AdminUsuarios::imagemValida($fotoUsuario) == false){
                $data = array('sucesso'=>false,'O formato especificado não está correto!');
            }

            //enviar formulario
            if($data['sucesso']){

                if($imagemAtualizada['name'] != ''){	

                    //valida campos chaves do formulario  
                    if(AdminUsuarios::imagemValida($imagemAtualizada) == false){
                        $data = array('sucesso'=>false,'O formato especificado não está correto!');
                    }else{
                        //valida se existe login de usuario já cadastrado
                        $verifica = MySql::conectar()->prepare("SELECT * FROM tb_admin_usuarios WHERE usuario=? AND id != ?");
                        $verifica->execute(array($login,$id));
                        if($verifica->rowCount() == 0){
                            //Valida se existe a foto antiga e exclui
                            if(AdminUsuarios::deletarFotoUsuario($fotoUsuario)){
                                //alterar o usuario no bando de dados  
                                $imagemAtualizada = AdminUsuarios::uploadFile($imagemAtualizada);										
                                if($adminUsuarios->alterarUsuarios($id,$login,$senha,$imagemAtualizada,$nome,$id_perfil)){
                                    $data = array('sucesso'=>true,'Usuário foi alterado com sucesso!');
                                    $adminUsuarios = AdminUsuarios::selecionarUsuario('tb_admin_usuarios','id = ?',array($id));                     	
                                }else{
                                    $data = array('sucesso'=>false,'Erro ao alterar o usuário!');
                                }
                            }else{
                                $data = array('sucesso'=>false,'Erro ao alterar o usuário!');
                            }
                        }else{
                            $data = array('sucesso'=>false,'Já existe um usuário com esse login!');
                            $adminUsuarios = AdminUsuarios::selecionarUsuario('tb_admin_usuarios','id = ?',array($id));  
                        }								
                    }						
                }else{
                    //valida se existe login de usuario já cadastrado  
                    $verifica = MySql::conectar()->prepare("SELECT * FROM tb_admin_usuarios WHERE usuario=? AND id != ?");
                    $verifica->execute(array($login,$id));
                    if($verifica->rowCount() == 0){						
                        //alterar o produto no bando de dados   								
                        if($adminUsuarios->alterarUsuarios($id,$login,$senha,$fotoUsuario,$nome,$id_perfil)){
                            $data = array('sucesso'=>true,'Usuário foi alterado com sucesso!');
                            $adminUsuarios = AdminUsuarios::selecionarUsuario('tb_admin_usuarios','id = ?',array($id));                     	
                        }else{
                            $data = array('sucesso'=>false,'Erro ao alterar o usuário!');
                        }
                    }else{
                        $data = array('sucesso'=>false,'Já existe um usuário com esse login!');
                        $adminUsuarios = AdminUsuarios::selecionarProduto('tb_admin_usuarios','id = ?',array($id));  
                    }	
                }

            }

            //encerra o processo returnando SUCESSO ou ERRO 
            die(json_encode($data));          
        
        //valida identificador form
        }else if($_POST['identificador'] == 'form_Usuario'){

            //percorre array para guardar sucesso ou erro
            $data = array('sucesso'=>true,'mensagem'=>'Informações validada com sucesso!');

            //variaveis de controle
            $login = $_POST['usuario'];
            $nome = $_POST['nome'];
            $senha = $_POST['password'];
            $validarSenha = $_POST['valid-password'];
            $fotoUsuario = $_FILES['imagemUsuario'];				
            $id_perfil = $_POST['id_perfil'];

            //instancia a classe USUARIO   
            $adminUsuarios = new AdminUsuarios();

            //valida od campos chavesdos os campos do formulario
            if($login == ''){
                $data = array('sucesso'=>false,'mensagem'=>'O login está vázio!');
            }else if($login != filter_var($login, FILTER_VALIDATE_EMAIL)){
                $data = array('sucesso'=>false,'mensagem'=>'Email digitado está incorreto!');                   
            }else if($nome == ''){
                $data = array('sucesso'=>false,'mensagem'=>'O nome está vázio!');                   
            }else if($senha == ''){
                $data = array('sucesso'=>false,'mensagem'=>'A senha está vázia!');                  
            }else if($id_perfil == ''){
                $data = array('sucesso'=>false,'mensagem'=>'O perfil precisa estar selecionado!');                   
            }else if($fotoUsuario['name'] == ''){
                $data = array('sucesso'=>false,'A imagem precisa estar selecionada!');
            }else if($senha != $validarSenha){
                $data = array('sucesso'=>false,'Senhas diferentes, favor tende novamente!');
            }else if(AdminUsuarios::imagemValida($fotoUsuario) == false){
                $data = array('sucesso'=>false,'O formato especificado não está correto!');
            }

            //enviar formulario
            if($data['sucesso']){

                //valida campos chaves do formulario 
                if(AdminUsuarios::imagemValida($fotoUsuario) == false){
                    $data = array('sucesso'=>false,'mensagem'=>'O formato especificado não está correto!');                    						
                }else{		
                    //valida se existe nome do usuario já cadastrado
                    $verifica = MySql::conectar()->prepare("SELECT * FROM tb_admin_usuarios WHERE usuario=?");
                    $verifica->execute(array($login));
                    if($verifica->rowCount() == 0){											
                        //cadastrar o usuario no bando de dados  
                        $fotoUsuario = AdminUsuarios::uploadFile($fotoUsuario);
                        if($adminUsuarios->cadastrarUsuarios($login,$senha,$fotoUsuario,$nome,$id_perfil)){
                            $data = array('sucesso'=>true,'mensagem'=>'O cadastro do usuário  foi feito com sucesso!');
                        }else{
                            $data = array('sucesso'=>false,'mensagem'=>'Erro ao cadastrar o usuário!');
                        }
                    }else{
                        $data = array('sucesso'=>false,'mensagem'=>'Já existe um usuário com esse login!');
                    }								
                }

            }

            //encerra o processo returnando SUCESSO ou ERRO
            die(json_encode($data));          

        }
        
    }else{

        $data = array('sucesso'=>false,'mensagem'=>'Erro ao tentar enviar informações!');         
        //encerra o processo returnando SUCESSO ou ERRO
        die(json_encode($data)); 

    }

?>
