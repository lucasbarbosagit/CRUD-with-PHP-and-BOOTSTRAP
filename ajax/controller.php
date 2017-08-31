<?php
ob_start(); session_start();
require '../funcoes/banco/conexao.php';
require '../funcoes/login/login.php';
require '../funcoes/crud/crud.php';
$acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);
 switch ($acao) :
   // Realiza login
   case 'login' :
      
      $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
      $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
     if(login($login, $senha)):
         //cria a sessao
            $_SESSION['usuarios'] = pegaLogin($login);
     else:
        $dados = pegaLogin($login);
        if(empty($login) || empty($senha)):
            echo 'vazio';
        elseif (!$dados) :
            echo 'naoexiste';
        elseif($dados->senha != $senha) :
          echo 'diferentesenha';
        elseif($dados->nivel_id = 1):
          echo 'nivel';
        endif;
     endif;

      break;

   // realiza cadastro
  case 'cadastro':

       $nome_completo = filter_input(INPUT_POST, 'nome_completo', FILTER_SANITIZE_STRING);
       $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
       $end_numero = filter_input(INPUT_POST, 'end_numero', FILTER_SANITIZE_STRING);
       $complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING);
       $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
       $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
       $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
       $nivel_id = filter_input(INPUT_POST, 'nivel_id', FILTER_SANITIZE_STRING);

    if (cadastro($nome_completo, $endereco, $email, $senha, $nivel_id, $complemento, $end_numero, $telefone)) :
      echo "cadastrou";
   endif;    
  break;

// realiza a edição
  case 'edit':
       $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
       $nome_completo = filter_input(INPUT_POST, 'nome_completo', FILTER_SANITIZE_STRING);
       $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
       $end_numero = filter_input(INPUT_POST, 'end_numero', FILTER_SANITIZE_STRING);
       $complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING);
       $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
       $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
       $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
       $nivel_id = filter_input(INPUT_POST, 'nivel_id', FILTER_SANITIZE_STRING);

     if (atualizar($nome_completo, $endereco, $email, $senha, $nivel_id, $complemento, $end_numero, $telefone, $id)) :
        echo "atualizou";
     endif;
 break;

// realiza um delete
 case 'excluir' :
      $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
     if (delete($id)) :
        echo "deletou";
     endif;
break;

  default :
     echo 'erro';
         break;

endswitch;
ob_end_flush();