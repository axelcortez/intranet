<!DOCTYPE html>
<html lang="en" >

   
<head>
    
        <meta charset="UTF-8">  
        <title>Votaciones</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css"> 
        
</head>
<link rel="icon" type="image/png" href="/img/favicon.ico" /> 
    <body onload="checarVotaciones()">
    <div id="container" ><!-- CONTENEDOR 1 -->
         <div class="nav-wrapper">
           <?php
                include('../menu/menu.php');
            ?>
        </div>
        <h3 class="header " align="center" style="color:#1a237e;">Votaciones Altares</h3>
        <div class="offset-s4" align="center"  id="opcionesVoto" style='display:none;'>      
            <p>
            <label>
                <input name="group1" type="radio" value="1" id="r1" />
                <span>Altar 1</span>
            </label>
            </p>
            <p>
            <label>
                <input name="group1" type="radio" value="2" id="r2" />
                <span>Altar 2</span>
            </label>
            </p>
            <p>
            <label>
                <input name="group1" type="radio" value="3" id="r3" />
                <span>Altar 3</span>
            </label>
            </p>
            <p>
            <label>
                <input name="group1" type="radio" value="4"  id="r4"/>
                <span>Altar 4</span>
            </label>
            </p>
            <p>
            <label>
                <input name="group1" type="radio" value="5" id="r5" />
                <span>Altar 5</span>
            </label>
            </p>
            <p>
            <label>
                <input name="group1" type="radio" value="6" id="r6" />
                <span>Altar 6</span>
            </label>
            </p>
            <p>
            <label>
                <input name="group1" type="radio" value="7" id="r7" />
                <span>Altar 7</span>
            </label>
            </p>
            <p>
            <label>
                <input name="group1" type="radio" value="8" id="r8" />
                <span>Altar 8</span>
            </label>
            </p>
            <p>
            <label>
                <input name="group1" type="radio" value="9" id="r9" />
                <span>Altar 9</span>
            </label>
            </p>
            <p>
            <label>
                <input name="group1" type="radio" value="10" id="r10" />
                <span>Altar 10</span>
            </label>
            </p>
            <p>
            <label>
                <input name="group1" type="radio" value="11" id="r11" />
                <span>Altar 11</span>
            </label>
            </p>
            <p>
            <label>
                <input name="group1" type="radio" value="12" id="r12" />
                <span>Altar 12</span>
            </label>
            </p>
            <p>
            <label>
                <input name="group1" type="radio" value="13" id="r13" />
                <span>Altar 13</span>
            </label>
            </p>
            <p>
            <label>
                <input name="group1" type="radio" value="14" ="r14" />
                <span>Altar 14</span>
            </label>
            </p>
            <p>
            <label>
                <input name="group1" type="radio" value="15" id="r15" />
                <span>Altar 15</span>
            </label>
            </p>
            <p>
            <label>
                <input name="group1" type="radio" value="16" id="r16" />
                <span>Altar 16</span>
            </label>
            </p>
            <p>
            <label>
                <input name="group1" type="radio" value="17" id="r17" />
                <span>Altar 17</span>
            </label>
            </p>
            <p>
            <label>
                <input name="group1" type="radio" value="18" id="r18" />
                <span>Altar 18</span>
            </label>
            </p>
            <p>
            <label>
                <input name="group1" type="radio" value="19" id="r19" />
                <span>Altar 19</span>
            </label>
            </p>
            <p>
            <label>
                <input name="group1" type="radio" value="20" id="r20" />
                <span>Altar 20</span>
            </label>
            </p>
        </div>
        <div class="col s12" align="center">
            <a id="btnVotar" class="waves-effect btn blue darken-4" disabled><i class="material-icons left">add</i>Votar</a>
            <br></br>
        </div>   
       
        
    </div>        
        

        <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
        <script type="text/javascript" src="../js/materialize.min.js"></script>
        <script type="text/javascript" src="../js/ajax.js"></script>
        <script type="text/javascript" src="../js/bancaprepa.js"></script>
        <script type="text/javascript" src="../js/js.cookie.js"></script>
        <script type="text/javascript" src="../js/equipo.js"></script>
        <script type="text/javascript" src="../js/votaciones.js"></script>

        <script>
            $(document).ready(function(){
                $('.sidenav').sidenav();
            });
        </script> 

    
 
    </body>
</html>