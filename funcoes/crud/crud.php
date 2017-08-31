<?php


// função para cadastrar users
function cadastro($nome_completo, $endereco, $email, $senha, $nivel_id, $complemento, $end_numero, $telefone){
    $pdo = conecta();
    try{
        $cadastro = $pdo -> prepare("INSERT INTO usuarios (nome_completo, endereco, email, senha, nivel_id, complemento, end_numero, telefone) VALUES (?,?,?,?,?,?,?,?)");
        $cadastro -> bindValue(1, $nome_completo, PDO::PARAM_STR);
        $cadastro -> bindValue(2, $endereco, PDO::PARAM_STR);
        $cadastro -> bindValue(3, $email, PDO::PARAM_STR);
        $cadastro -> bindValue(4, $senha, PDO::PARAM_STR);
        $cadastro -> bindValue(5, $nivel_id, PDO::PARAM_STR);
        $cadastro -> bindValue(6, $complemento, PDO::PARAM_STR);
        $cadastro -> bindValue(7, $end_numero, PDO::PARAM_STR);
        $cadastro -> bindValue(8, $telefone, PDO::PARAM_STR);
        $cadastro   -> execute();
     
        if ($cadastro -> rowCount() > 0) : 
           return true;
        else :
           return false;
        endif;
    }catch(PDOException $e) {
        echo $e -> getMessage();
    }
}


// Funcao de listar

function listarAdmin(){
    $pdo = conecta();
    try {
        $listar = $pdo -> query("SELECT * FROM usuarios");
        
        if ($listar -> rowCount() > 0) :
             return $listar->fetchAll(PDO::FETCH_OBJ);
        else :
             return FALSE;
        endif;
    } catch(PDOException $e){
        echo $e -> getMessage();
    }
    
}

// Funcao de PEGARID

function pegaId($id){
    $pdo = conecta();
    try {
        $pegaid = $pdo -> prepare("SELECT * FROM usuarios WHERE id = ?");
        $pegaid->bindValue(1, $id, PDO::PARAM_INT);
        $pegaid->execute();
        
        if ($pegaid -> rowCount() > 0) :
             return $pegaid->fetch(PDO::FETCH_OBJ);
        else :
             return FALSE;
        endif;
    } catch(PDOException $e){
        echo $e -> getMessage();
    }
    
}


// funcao atualizar

function atualizar($nome_completo, $endereco, $email, $senha, $nivel_id, $complemento, $end_numero, $telefone, $id){
    $pdo = conecta();
    try{
    $atualizar = $pdo -> prepare("UPDATE usuarios SET nome_completo=?, endereco=?, email=?, senha=?, nivel_id=?, complemento=?, end_numero=?, telefone=? WHERE id =?");
        $atualizar -> bindValue(1, $nome_completo, PDO::PARAM_STR);
        $atualizar -> bindValue(2, $endereco, PDO::PARAM_STR);
        $atualizar -> bindValue(3, $email, PDO::PARAM_STR);
        $atualizar -> bindValue(4, $senha, PDO::PARAM_STR);
        $atualizar -> bindValue(5, $nivel_id, PDO::PARAM_STR);
        $atualizar -> bindValue(6, $complemento, PDO::PARAM_STR);
        $atualizar -> bindValue(7, $end_numero, PDO::PARAM_STR);
        $atualizar -> bindValue(8, $telefone, PDO::PARAM_STR);
        $atualizar -> bindValue(9, $id, PDO::PARAM_INT);
        $atualizar -> execute();
     
        if ($atualizar -> rowCount() == 1) : 
           return TRUE;
        else :
           return FALSE;
        endif;
    }catch(PDOException $e) {
        echo $e -> getMessage();
    }
}




// funcao deletar

function delete($id){
    $pdo = conecta();
    try{
        $delete = $pdo -> prepare("DELETE FROM usuarios WHERE id = ?");
        $delete->bindValue(1, $id, PDO::PARAM_INT);
        $delete->execute();
        
        if($delete -> rowCount() == 1) :
            return TRUE;
        else : 
            return FALSE;
        endif;
    } catch(PDOException $e) {
         echo $e -> getMessage();
    }
}