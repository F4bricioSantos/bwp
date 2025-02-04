<?php 
  $server ="Localhost";
  $user = "root";
  $pass = "";
  $bd = "bwp";

  if ($conn = mysqli_connect($server, $user, $pass, $bd)) {
      // echo"sucesso";
   }else{
    echo "erro";
}
