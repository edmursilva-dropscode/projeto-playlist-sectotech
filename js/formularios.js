$(function(){

    //configuracao JQUERY/AJAX para trabalhar em tempo real no site 
	$('body').on('submit','form.ajax-form',function(event){

		//valida se a tela recarreg dando refresh
		//event.preventDefault();

		//valida form de acao 
		var inputIdentificador = $("input[name='identificador']",this).val();

		//valida identificador form 
		if(inputIdentificador == "form_FormularioLogin") {

			//aqui os demais form da pagina principal  
			var form = $(this);

			$.ajax({
				//funcao que executa antes de enviar o formulario  
				beforeSend:function(){
					console.log("Enviando informações");
					//habilita logo/gif
					$('.overlay-loading').fadeIn();
				},
				url:include_path+'ajax/formularios.php',
				method:'post', 
				dataType: 'json', 
				data: form.serialize()
			}).done(function(data){
				if(data.sucesso){
					//tudo certo 
					setTimeout(function(){
						//deshabilita logo/gif
						$('.overlay-loading').fadeOut();
						//habilida mensagem
						$('.sucesso').fadeIn();
						setTimeout(function(){
							//deshabilita mensagem
							$('.sucesso').fadeOut();
						},2000)			
					},4000)				
					console.log('Informações enviada com sucesso!');
					//reset form
					$('#formFormularioLogin').trigger("reset");
					//
					window.location="".INCLUDE_PATH_PAINEL;
					//
				}else{
					//algo deu errado.
					setTimeout(function(){
						//deshabilita logo/gif
						$('.overlay-loading').fadeOut();
						//habilida mensagem
						$('.erro').fadeIn();
						setTimeout(function(){
							//deshabilita mensagem
							$('.erro').fadeOut();
						},2000)			
					},4000)	
					console.log('Ocorreu um erro ao enviar as informações!');
					//reset form
					$('#formFormularioLogin').trigger("reset");				
				}
			});	

		//valida identificador form 
		}else if(inputIdentificador == "form_EditarConteudo") {

			$.ajax({
				//funcao que executa antes de enviar o formulario 
				beforeSend:function(){
					console.log("Enviando informações");
					//habilita logo/gif
					$('.overlay-loading').fadeIn();
				},													
				type: 'POST',
				url:include_path+'ajax/formularios.php',
				data: new FormData(this),
				dataType: 'json',
				contentType: false,
				cache: false,
				processData:false

			}).done(function(data){
				if(data.sucesso){
					//tudo certo 
					setTimeout(function(){
						//deshabilita logo/gif
						$('.overlay-loading').fadeOut();
						//habilida mensagem
						$('.sucesso').text(data.mensagem);
						$('.sucesso').fadeIn();
						setTimeout(function(){
							//deshabilita mensagem
							$('.sucesso').fadeOut();
						},4000)			
					},6000)				
					console.log('Informações enviada com sucesso!');
					//reset form
					//$('#formConteudo').trigger("reset"); 
				}else{
					//algo deu errado.
					setTimeout(function(){
						//deshabilita logo/gif
						$('.overlay-loading').fadeOut();
						//habilida mensagem
						$('.erro').text(data.mensagem);
						$('.erro').fadeIn();
						setTimeout(function(){
							//deshabilita mensagem
							$('.erro').fadeOut();
						},4000)			
					},6000)	
					console.log('Ocorreu um erro ao enviar as informações!');
				}
			});	 

		//valida identificador form 
		}else if(inputIdentificador == "form_Conteudo") {

			$.ajax({
				//funcao que executa antes de enviar o formulario 
				beforeSend:function(){
					console.log("Enviando informações");
					//habilita logo/gif
					$('.overlay-loading').fadeIn();
				},													
				type: 'POST',
				url:include_path+'ajax/formularios.php',
				data: new FormData(this),
				dataType: 'json',
				contentType: false,
				cache: false,
				processData:false

			}).done(function(data){
				if(data.sucesso){
					//tudo certo 
					setTimeout(function(){
						//deshabilita logo/gif
						$('.overlay-loading').fadeOut();
						//habilida mensagem
						$('.sucesso').text(data.mensagem);
						$('.sucesso').fadeIn();
						setTimeout(function(){
							//deshabilita mensagem
							$('.sucesso').fadeOut();
						},4000)			
					},6000)				
					console.log('Informações enviada com sucesso!');
					//reset form
					$('#formConteudo').trigger("reset"); 
				}else{
					//algo deu errado.
					setTimeout(function(){
						//deshabilita logo/gif
						$('.overlay-loading').fadeOut();
						//habilida mensagem
						$('.erro').text(data.mensagem);
						$('.erro').fadeIn();
						setTimeout(function(){
							//deshabilita mensagem
							$('.erro').fadeOut();
						},4000)			
					},6000)	
					console.log('Ocorreu um erro ao enviar as informações!');
				}
			});	 

		//valida identificador form 
		}else if(inputIdentificador == "form_EditarPlaylist") {

			$.ajax({
				//funcao que executa antes de enviar o formulario 
				beforeSend:function(){
					console.log("Enviando informações");
					//habilita logo/gif
					$('.overlay-loading').fadeIn();
				},													
				type: 'POST',
				url:include_path+'ajax/formularios.php',
				data: new FormData(this),
				dataType: 'json',
				contentType: false,
				cache: false,
				processData:false

			}).done(function(data){
				if(data.sucesso){
					//tudo certo 
					setTimeout(function(){
						//deshabilita logo/gif
						$('.overlay-loading').fadeOut();
						//habilida mensagem
						$('.sucesso').text(data.mensagem);
						$('.sucesso').fadeIn();
						setTimeout(function(){
							//deshabilita mensagem
							$('.sucesso').fadeOut();
						},4000)			
					},6000)				
					console.log('Informações enviada com sucesso!');
					//reset form
					//$('#formEditarPlaylist').trigger("reset"); 
				}else{
					//algo deu errado.
					setTimeout(function(){
						//deshabilita logo/gif
						$('.overlay-loading').fadeOut();
						//habilida mensagem
						$('.erro').text(data.mensagem);
						$('.erro').fadeIn();
						setTimeout(function(){
							//deshabilita mensagem
							$('.erro').fadeOut();
						},4000)			
					},6000)	
					console.log('Ocorreu um erro ao enviar as informações!');
				}
			});	 

		//valida identificador form 
		}else if(inputIdentificador == "form_Playlist") {

			$.ajax({
				//funcao que executa antes de enviar o formulario 
				beforeSend:function(){
					console.log("Enviando informações");
					//habilita logo/gif
					$('.overlay-loading').fadeIn();
				},													
				type: 'POST',
				url:include_path+'ajax/formularios.php',
				data: new FormData(this),
				dataType: 'json',
				contentType: false,
				cache: false,
				processData:false

			}).done(function(data){
				if(data.sucesso){
					//tudo certo 
					setTimeout(function(){
						//deshabilita logo/gif
						$('.overlay-loading').fadeOut();
						//habilida mensagem
						$('.sucesso').text(data.mensagem);
						$('.sucesso').fadeIn();
						setTimeout(function(){
							//deshabilita mensagem
							$('.sucesso').fadeOut();
						},4000)			
					},6000)				
					console.log('Informações enviada com sucesso!');
					//reset form
					$('#formPlaylist').trigger("reset"); 
				}else{
					//algo deu errado.
					setTimeout(function(){
						//deshabilita logo/gif
						$('.overlay-loading').fadeOut();
						//habilida mensagem
						$('.erro').text(data.mensagem);
						$('.erro').fadeIn();
						setTimeout(function(){
							//deshabilita mensagem
							$('.erro').fadeOut();
						},4000)			
					},6000)	
					console.log('Ocorreu um erro ao enviar as informações!');
				}
			});	 

		//valida identificador form 
		}else if(inputIdentificador == "form_EditarUsuario") {	

			$.ajax({
				//funcao que executa antes de enviar o formulario
				beforeSend:function(){
					console.log("Enviando informações");
					//habilita logo/gif
					$('.overlay-loading').fadeIn();
				},													
				type: 'POST',
				url:include_path+'ajax/formularios.php',
				data: new FormData(this),
				dataType: 'json',
				contentType: false,
				cache: false,
				processData:false

			}).done(function(data){
				if(data.sucesso){
					//tudo certo 
					setTimeout(function(){
						//deshabilita logo/gif
						$('.overlay-loading').fadeOut();
						//habilida mensagem
						$('.sucesso').text(data.mensagem);
						$('.sucesso').fadeIn();
						setTimeout(function(){
							//deshabilita mensagem
							$('.sucesso').fadeOut();
						},4000)			
					},6000)				
					console.log('Informações enviada com sucesso!');
					//reset form
					//$('#formEditarUsuario').trigger("reset"); 
					//reset imagem socioAvulso
					//$('#imagem-upload-usuario').attr('src',include_path+'img/imagemUsuario.png')
				}else{
					//algo deu errado.
					setTimeout(function(){
						//deshabilita logo/gif
						$('.overlay-loading').fadeOut();
						//habilida mensagem
						$('.erro').text(data.mensagem);
						$('.erro').fadeIn();
						setTimeout(function(){
							//deshabilita mensagem
							$('.erro').fadeOut();
						},4000)			
					},6000)	
					console.log('Ocorreu um erro ao enviar as informações!');
				}
			});	 

		//valida identificador form  
		}else if(inputIdentificador == "form_Usuario") {		

			$.ajax({
				//funcao que executa antes de enviar o formulario
				beforeSend:function(){
					console.log("Enviando informações");
					//habilita logo/gif
					$('.overlay-loading').fadeIn();
				},													
				type: 'POST',
				url:include_path+'ajax/formularios.php',
				data: new FormData(this),
				dataType: 'json',
				contentType: false,
				cache: false,
				processData:false

			}).done(function(data){
				if(data.sucesso){
					//tudo certo 
					setTimeout(function(){
						//deshabilita logo/gif
						$('.overlay-loading').fadeOut();
						//habilida mensagem
						$('.sucesso').text(data.mensagem);
						$('.sucesso').fadeIn();
						setTimeout(function(){
							//deshabilita mensagem
							$('.sucesso').fadeOut();
						},4000)			
					},6000)				
					console.log('Informações enviada com sucesso!');
					//reset form
					$('#formUsuario').trigger("reset"); 
					//reset imagem socioAvulso
					$('#imagem-upload-usuario').attr('src',include_path+'img/imagemUsuario.png')
				}else{
					//algo deu errado.
					setTimeout(function(){
						//deshabilita logo/gif
						$('.overlay-loading').fadeOut();
						//habilida mensagem
						$('.erro').text(data.mensagem);
						$('.erro').fadeIn();
						setTimeout(function(){
							//deshabilita mensagem
							$('.erro').fadeOut();
						},4000)			
					},6000)	
					console.log('Ocorreu um erro ao enviar as informações!');
				}
			});	 

		}
		return false; 
	})

})



