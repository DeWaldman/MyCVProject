<?php
  
  $conectar = new mysqli("127.0.0.1", "root", "", "sitedb");
  $comentario=$_GET["comentario"];

  if ($comentario == ""){echo "vazio";}
  else{
    $st = $conectar->prepare("INSERT INTO feedback VALUES (DEFAULT, ?)");
    $st->bind_param("s", $comentario); $st->execute();
  }
  
  mysqli_close($conectar);
  header('Location: index.html');

?>
