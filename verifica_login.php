<?php
    if (session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }
    
	if(!(isset($_SESSION["nome"]))){
        echo '<link rel = "stylesheet" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity = "sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin = "anonymous" />
              <div class = "container-fluid mt-2">
                <div class = "alert alert-danger" role = "alert">
                    <h4 class = "alert-heading">Você não está logado! <img src = "triste.png" /></h4>
                    <p>Para acessar essa página, por favor, faça o <a class = "text-danger" href = "index.php">LOGIN</a>!</p>
                </div>
              </div>';
		die();
	}
?>