<?php
require '../funcoes/banco/conexao.php';
require '../funcoes/crud/crud.php';    
$acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);
    
switch ($acao) {
    case 'form_cad':
        ?>

 <div class="retorno"></div>

<form action="" name="form_cad" method="post"> 
  <div class="form-group">
    <label for="nome_completo">Nome Completo</label>
    <input type="text" name="nome_completo" class="form-control" placeholder="Digite o Nome Completo">
  </div>
    <div class="form-group">
    <label for="endereco">Endereço</label>
    <input type="text" name="endereco" class="form-control" placeholder="Digite o Endereço">
  </div>
    <div class="form-group">
    <label for="end_numero">Numero</label>
    <input type="text" name="end_numero" class="form-control" placeholder="Digite o Numero do Endereço">
  </div>
    <div class="form-group">
    <label for="complemento">Complemento</label>
    <input type="text" name="complemento" class="form-control" placeholder="Digite o Complemento do Endereço(se tiver)">
  </div>
    <div class="form-group">
      <label for="telefone">Telefone</label>  <!--  arrumar mascara depois-->
    <input type="text" name="telefone" class="form-control" placeholder="Digite o Telefone ou Celular">
  </div>
  <div class="form-group">
    <label for="Email">Email(Usuario)</label>
    <input type="email" name="email" class="form-control" placeholder="Digite um Email(Usuario)">
  </div>
  <div class="form-group">
    <label for="senha">Senha</label>
    <input type="password" name="senha" class="form-control" placeholder="Digite uma Senha">
  </div>
    <div class="form-group">
    <label for="nivel_id">Nivel</label>
        <select class="form-control" name="nivel_id">
            <option value=""> Escolha uma opção</option>
            <option value="1"> Administrador</option>
            <option value="2"> Aluno</option>
        </select>
  </div>
    
    <div class="checkbox">
    <p class="pull-right">
        <img src="img/load.svg" class="load" alt="Carregando" style="display: none;" />
        <button type="submit" class="btn btn-default">Cadastrar</button>
    </p> 
    </div>
</form>
     <?php
      break;
 
case 'listar_admin' :
    if (listarAdmin()) :
    $admin = listarAdmin();
    foreach($admin as $adm):
    $nivel = ($adm->nivel_id == 1) ? 'Admin' : 'Aluno';    
    ?>
        <tr>
           <td><?php echo $adm->nome_completo; ?></td>
           <td><?php echo $adm->telefone; ?></td>
           <td><?php echo $adm->email; ?></td>
           <td><?php echo $nivel; ?></td>        
           <td>
              <a href="#" id="btn_edit" data-id="<?php echo $adm->id; ?>" class="btn btn-warning">Editar</a>
              <a href="#" id="btn_excluir" data-id="<?php echo $adm->id; ?>" class="btn btn-danger">Excluir</a>
           </td>     
        </tr>
     <?php
     endforeach; 
     else :

     endif;

break;

        case'form_edit':
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $dados = pegaId($id);
        ?>
        
         <div class="retorno"></div>

<form action="" name="form_edit" method="post"> 
  <div class="form-group">
    <label for="nome_completo">Nome Completo</label>
    <input type="text" name="nome_completo" value="<?php echo $dados->nome_completo; ?>" class="form-control" placeholder="Digite o Nome Completo">
  </div>
    <div class="form-group">
    <label for="endereco">Endereço</label>
    <input type="text" name="endereco" value="<?php echo $dados->endereco;?>" class="form-control" placeholder="Digite o Endereço">
  </div>
    <div class="form-group">
    <label for="end_numero">Numero</label>
    <input type="text" name="end_numero" value="<?php echo $dados->end_numero; ?>" class="form-control" placeholder="Digite o Numero do Endereço">
  </div>
    <div class="form-group">
    <label for="complemento">Complemento</label>
    <input type="text" name="complemento" value="<?php echo $dados->complemento;?>" class="form-control" placeholder="Digite o Complemento do Endereço(se tiver)">
  </div>
    <div class="form-group">
      <label for="telefone">Telefone</label>  <!--  arrumar mascara depois-->
    <input type="text" name="telefone" value="<?php echo $dados->telefone;?>" class="form-control" placeholder="Digite o Telefone ou Celular">
  </div>
  <div class="form-group">
    <label for="Email">Email(Usuario)</label>
    <input type="email" name="email" value="<?php echo $dados->email;?>" class="form-control" placeholder="Digite um Email(Usuario)">
  </div>
  <div class="form-group">
    <label for="senha">Senha</label>
    <input type="password" name="senha" value="<?php echo $dados->senha;?>" class="form-control" placeholder="Digite uma Senha">
  </div>
    <div class="form-group">
    <label for="nivel_id">Nivel</label>
        <select class="form-control" name="nivel_id" value="<?php echo $dados->nivel_id;?>">
            <option value=""> Escolha uma opção</option>
            <option value="1"> Administrador</option>
            <option value="2"> Aluno</option>
        </select>
  </div>
    
    <input type="hidden" name="id" value="<?php echo $dados->id;?>" />
    
    <div class="checkbox">
    <p class="pull-right">
        <img src="img/load.svg" class="load" alt="Carregando" style="display: none;" />
        <button type="submit" class="btn btn-default">Atualizar</button>
    </p> 
    </div>
</form>
        
        
   <?php break;    
     
        
        

     break;
  default:
     echo 'Nada';
     break; 
        
}