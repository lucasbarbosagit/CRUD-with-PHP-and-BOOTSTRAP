<?php

//Function de login

function login($login, $senha){
    
    $pdo = conecta();
    try{
        
        $logar = $pdo -> prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ? AND nivel_id = '1'");
        $logar -> bindValue(1, $login, PDO::PARAM_STR);
        $logar -> bindValue(2, $senha, PDO::PARAM_STR);
        $logar -> execute();
        
        if ($logar -> rowCount() == 1) :
             return TRUE;
        else :
             return FALSE;
        endif;
    } catch(PDOException $e) {    
        echo $e -> getMessage();
    }
       
}

// Pega login
function pegaLogin($login) {
    $pdo = conecta();
    try {
        $bylogin = $pdo -> prepare("SELECT * FROM usuarios WHERE email = ?");
        $bylogin -> bindValue(1, $login, PDO::PARAM_STR);
        $bylogin -> execute();
        
        if ($bylogin) :
            return $bylogin->fetch(PDO::FETCH_OBJ); 
        else :
            return FALSE;
        endif;
    } catch(PDOException $e){
        echo $e -> getMessage();
    }
        
}

// Administrador logado
function logado($sessao){
    if(!isset($_SESSION[$sessao]) || empty($_SESSION[$sessao])) :
       header("Location: index.php");
    else :
    return TRUE;
    endif;
}