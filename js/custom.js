$(document).ready(function(){
	
	$('form[name="form_login"]').submit(function(){
        var forma = $(this);
        var botao = $(this).find(':button');
        
       $.ajax({
           url: "ajax/controller.php",
           type : "POST",
           data : "acao=login&" + forma.serialize(),
           beforeSend: function(){     
               botao.attr('disabled', true);
               $('.load').fadeIn('slow');
           }, 
            success : function(retorno){
                $('.load').fadeOut('slow', function(){
                     botao.attr('disabled', false);
                }); 
                if (retorno === 'vazio'){
                    msg('É preciso digitar o Login e Senha para continuar', 'alerta');
                } else if(retorno === 'naoexiste'){
                    msg('Este login não foi encontrado em nossos registros', 'erro');
                } else if(retorno === 'diferentesenha'){
                    msg('A senha digitada não corresponde este Login, verifique e tente novamente', 'info');
                } else if(retorno ==='nivel'){
                   forma.fadeOut('fast', function(){
                        msg('Login efetuado com sucesso, aguarde...', 'sucesso');
                        $('#load').fadeIn('slow');
                    });
                    
                    setTimeout(function(){
                        $(location).attr('href', 'aluno.php');          
                    }, 3000);
                        
                } else{
                    
                    forma.fadeOut('fast', function(){
                        msg('Login efetuado com sucesso, aguarde...', 'sucesso');
                        $('#load').fadeIn('slow');
                    });
                    
                    setTimeout(function(){
                        $(location).attr('href', 'painel.php');          
                    }, 3000);
                }
            }
       });
		
	
	return false;
  });
    
// funcoes geral

  function msg(msg, tipo){
      var retorno = $('.retorno');
      var tipo = (tipo === 'sucesso') ? 'success' : (tipo === 'alerta') ? 'warning' : (tipo === 'erro') ? 'danger' : (tipo === 'info') ? 'info' : alert('INFORME MENSAGENS DE SUCESSO, ALERTA, ERRO E INFO');
      
      retorno.empty().fadeOut('fast', function(){
         return $(this).html('<div class="alert alert-'+tipo+'">'+msg+'</div>').fadeIn('slow');                          
    });   
      
      setTimeout(function(){
          
          retorno.fadeOut('slow').empty();
          
      }, 9000);  
      
  
  }
    
}); 