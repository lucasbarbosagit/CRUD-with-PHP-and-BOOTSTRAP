$(document).ready(function(){

    
    var janela = $('#janela');
    var conteudo = $('.modal-body');

  janela.click(function(){
      
    $.post('ajax/painel.php', {acao: 'form_cad'}, function(retorno){
       $('#myModal').modal({backdrop: 'static'});
        conteudo.html(retorno);  
    });
      
  });
    
    
    $("#myModal").on("submit", 'form[name="form_cad"]', function(){
        var form = $(this);
        var botao = form.find(':button');
        
        $.ajax({
            url: 'ajax/controller.php',
            type: 'POST',
            data: 'acao=cadastro&' + form.serialize(),
            beforeSend: function(){
                botao.attr('disabled', true);
                $('.load').fadeIn('slow');  
            },
                
             success : function(retorno){
                 botao.attr('disabled', false);
                 $('.load').fadeOut('slow');
                if (retorno === 'cadastrou') {
                    form.fadeOut('slow', function(){
                    msg('Administrador cadastrado com sucesso', 'sucesso');
                    listarAdmin('ajax/painel.php', 'listar_admin', true);
                   });
                    
                }else{
                    msg('Erro ao cadastrar administrador', 'erro');
                } 

            }
            
        }); 
        
        return false;
    });
    
    
    //btn edit 
    
$('.table').on("click", '#btn_edit', function(){
   var id = $(this).attr('data-id');
    $.post('ajax/painel.php', {acao: 'form_edit', id: id}, function(retorno){
        $('#myModal').modal({backdrop: 'static'});
       conteudo.html(retorno);
    });
      return false; 
});
    
    
    //btn atualiza 
    
  $('#myModal').on("submit", 'form[name="form_edit"]', function(){
     var dados = $(this);
     var botao = dados.find(':button');
      
     $.ajax({
        url: 'ajax/controller.php',
        type: 'POST',
         data: 'acao=edit&'+dados.serialize(),
         beforeSend: function(){
             botao.attr('disabled', true);
             $('.load').fadeIn('slow');
                          
         },
         
         success: function(retorno){
           if(retorno === 'atualizou'){     
             dados.fadeOut('slow', function(){
                 msg('Administrador atualizado', 'sucesso');
                 listarAdmin('ajax/painel.php', 'listar_admin', true);      
             });
           }else{
               msg('Você não alterou nenhum dados do usuário', 'alerta');
               $('.load').fadeOut('slow', function(){
                   botao.attr('disabled', false);
               });
           }          
         }
         
     });
      
      return false;
  });  
    
    
    // btn excluir
    $('.table').on('click', '#btn_excluir', function(){
        var id = $(this).attr('data-id');
        
        if (confirm("Você deseja realmente excluir este administrador")){
            $.post('ajax/controller.php', {acao : 'excluir', id: id}, function(retorno){
                if (retorno === 'deletou'){
                    alert('cadastrou');
                    listarAdmin('ajax/painel.php', 'listar_admin', true); 
                }else {
                    alert('erro ao excluir usuario');
                }
                
            });
        }else{
            return false;
        }
        
    });
    
    
  function listarAdmin(url, acao, atualizar){  
        $.post(url, {acao: acao}, function(retorno){
              var tbody = $('.table').find('tbody');
              var load = tbody.find('.load');
            
            if (atualizar === true){
                  tbody.html(retorno);
            }else{
              load.fadeOut('slow', function(){
              tbody.html(retorno);
            });
            }
            
        });
    }
    
  
// realiza a listagem via jquery    
    listarAdmin('ajax/painel.php', 'listar_admin');             
                 
    
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