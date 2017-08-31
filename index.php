<?php
require 'funcoes/banco/conexao.php';
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Awesome Flat Login Form" />
  <meta name="keywords" content="Login, Flat, HTML5, CSS3" />
  <meta name="author" content="Wahid Anggara - LunarPixel - Lucas Barbosa" />
  <title>Página de Login</title>
    
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="css/login_style.css" rel="stylesheet" type="text/css">  
  <link href="css/font-awesome.css" rel="stylesheet" type="text/css">
  <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">

  <link rel="shortcut icon" href="img/favicon.ico"/>
  <link rel="apple-touch-icon" href="img/favicon.png"/>

</head>
<body>
  <div class="logo"></div>
 
  <div class="login"> <!-- Login -->
    <h1>Logue na sua conta</h1>
  
    <div class="retorno"></div>
      <form class="form" method="post" action="" name="form_login">
          
  
      <p class="field">
        <input type="text" name="login" placeholder="Email(usuário)" required/>
        <i class="fa fa-user"></i>
      </p>

      <p class="field">
        <input type="password" name="senha" placeholder="Senha" required/>
        <i class="fa fa-lock"></i>
      </p>

        <p class="submit"><button type="submit" name="commit">Login</button></p>
       <p><center><img src="img/load.svg" class="load" alt="Carregando" style="display: none;" /></center></p>    
      <p class="remember">
        <input type="checkbox" id="remember" name="remember" />
        <label for="remember"><span></span>Lembrar login</label>
      </p>
          <div id="plataforma"></div>
    </form>
       <center><img src="img/load-login.svg" align="center" id="load" alt="carregando" style="display: none;" /></center>
  </div> <!--/ Login-->
    <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
</body>
</html>