<?php

  $usern = $_POST["username"];
  $userp = $_POST["password"];
  $lista_resu = array();
  $conectar = new mysqli("127.0.0.1", "root", "", "sitedb");

  #------------------------------------------------------------------

  function print_mypage(){ #imprime as infomacoes na pagina
    $sql_array = (sqlquerydados());
    $registros = 0;
    echo '<table style="width:50%">';
    echo "
    <tr>
      <th>ID Mensagem</th>
      <th>Mensagem</th> 
    </tr>";
    echo "<tr>";
    while ($registros<count($sql_array)){
      echo "<tr>";
        echo "<td>";
          echo $sql_array[$registros]["id"];
        echo "</td>";
        echo "<td>";
          echo $sql_array[$registros]["msg"];
        echo "</td>";
      echo "<tr>";
      $registros = $registros + 1;
    }
    echo "</table>";
  }
  
  function sqlquerydados(){ #pega as mensagens do banco de dados
    global $conectar;
    $sql = "SELECT * FROM feedback";
    $sql = mysqli_query($conectar, $sql);
    $simple_arry = array();
    while ($row = mysqli_fetch_array($sql)){
     array_push($simple_arry, array("id"=>$row["id_fb"],"msg"=>$row["mensagens"]));  
    }
    return $simple_arry;
  }

  function sqlquerylogin(){ #verificacao para o login
    global $conectar, $usern, $userp; 
    $st = $conectar->prepare("SELECT * FROM user WHERE username = ? AND userpasswd = ?");
    $st->bind_param("ss", $usern, $userp);
    $st->execute();
    $resu_query = $st->get_result();
    return $resu_query->fetch_assoc();
  }
  
  #-------------------------------------------------------------------------

  if ($usern == "" or $userp == ""){
    mysqli_close($conectar);
    header('Location: index.html');
  }
  else{
    $lista_resu = sqlquerylogin();
    if ($lista_resu["username"] == $usern and $lista_resu["userpasswd"] == $userp) {
      print_mypage();
    }else {
      mysqli_close($conectar);
      header('Location: index.html');
    }
    mysqli_close($conectar);
  }
?>
