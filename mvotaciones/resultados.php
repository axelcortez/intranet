 <?php
  require_once("../php/conexion/conexion.php");
 
  $Conectar = new Conectar(); 

     


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 
  </head>
  <body>
    <div class="container">
    <center><h1>Resultados de Votaciones</h1></center>
      <br><br><br>
    <?php

     $sql="SELECT COUNT(v.`id`)
            FROM b_votaciones v 
            ORDER BY COUNT(v.id) DESC"; 
      $resultado = mysqli_query($Conectar->con(), $sql);  
        while ($res = mysqli_fetch_row($resultado)) {  
                  $tvotos  = $res[0];  
        } 

       echo ' <center><h3>Total Votos: <b>'.$tvotos.'</b> </h3></center>';



          $sql="SELECT sv.sucursal, COUNT(v.`id`)
            FROM b_votaciones v
            INNER JOIN capturistas c ON c.id=v.capturista_id
            RIGHT JOIN b_sucursales_votaciones sv ON sv.numero=v.id_suc 
            GROUP BY sv.sucursal
            ORDER BY COUNT(v.id) DESC
            "; 
      $resultado = mysqli_query($Conectar->con(), $sql);  
        while ($res = mysqli_fetch_row($resultado)) {  
                  $sucursal  = $res[0]; 
                  $votos     = $res[1];


                  echo $sucursal.'<div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: '.$votos.'%" aria-valuenow="'.$votos.'" aria-valuemin="0" aria-valuemax="100"></div>'.$votos.'
                        </div><br>';
        } 


    ?>
    
      
      
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>