<?php
  $registros = array();
  $lasInsertID = 0;
   //Realizar la conexion con MySQL
    $conn = new mysqli("127.0.0.1", "root", "", "nw201501");
    if($conn->errno){
      die("DB no can: " . $conn->error);
    }
    
  if(isset($_POST["btnIns"])){
    $registro = array();
    $registro["prvid"] = 0;
    $registro["prvdsc"] = $_POST["txtDsc"];
    $registro["prvemail"] = $_POST["txtMail"];
    $registro["prvtel"] = $_POST["txtTel"];
    $registro["prvcont"] = $_POST["txtContac"];
    $registro["prvdir"] = $_POST["txtDirec"];
    $registro["prvest"] = $_POST["txtEstado"];
 
   
    //Preparar el Insert Statement
    $sqlstr = "INSERT INTO `nw201501`.`proveedores`(`prvdsc`,`prvemail`,`prvtel`,`prvcont`,`prvdir`,`prvest`)";
    $sqlstr .= "VALUES ('" . $registro["prvdsc"]  . "',  '". $registro["prvemail"] ."','" . $registro["prvtel"]  . "','" . $registro["prvcont"]  . "','" . $registro["prvdir"]  . "','" . $registro["prvest"]  . "');";
       
     //Ejecutar el Insert Statement
    $result = $conn->query($sqlstr);
    
    //Obtener el último codigo generado
    $lasInsertID= $conn->insert_id;
    
    //Obtener los registros de la tabla
     $sqlQuery  = "Select * from proveedores;";
     $resulCursor = $conn->query($sqlQuery);
                                        //fetch: agarrar de ese cursor la posiciona actual del registro
                                        //y assoc el valor del registro asociativo
    while($registro = $resulCursor->fetch_assoc()){
    $registros[] = $registro;
  }
    
  }
  
  
  
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Mantenimiento de la tabla Proveedores</title>
  </head>
  <body>
    <h1>Proveedores</h1>
    <form action="Mantenimiento2Nr.php" method="POST">
   
        <label for="txtDsc">Descripción</label>
        <input type="text" name="txtDsc" id="txtDsc" />
        <br/>
        <br/>
        <label for="txtTel">Teléfomo</label>
        <input type="text" name="txtTel" id="txtTel" />
        <br/>
        <br/>
        <label for="txtMail">E mail</label>
        <input type="text" name="txtMail" id="txtMail" />
        <br/>
        <br/>
        <label for="txtContac">Contacto</label>
        <input type="text" name="txtContac" id="txtContac" />
        <br/>
        <br/>
        <label for="txtDirec">Dirección</label>
        <input type="text" name="txtDirec" id="txtDirec" />
        <br/>
        <br/>
      <select name="txtEstado" id="txtEstado">
            <option value="PND">Pendiente</option>
            <option value="CNF">Confirmado</option>
            <option value="CNL">Cancelado</option>
        </select>
        <br/>
        
        <input type="submit" name="btnIns" value="Guardar" />
 
    </form>
    <div>
      <h2>Datos</h2>
      <?php if($lasInsertID) echo "Último ID generado = $lasInsertID" ?>
      <table border="1">
        <tr>
          <th>Codigo</th>
          <th>Descripción</th>
          <th>E mail</th>
          <th>Teléfono</th>
          <th>Contacto</th>
          <th>Dirección</th>
          <th>Estado</th>
        </tr>
      <?php
        if(count($registros) > 0){
          foreach($registros as $registro){
            echo "<tr><td>".$registro["prvid"]."</td>";
            echo "<td>".$registro["prvdsc"]."</td>";
            echo "<td>".$registro["prvemail"]."</td>";
            echo "<td>".$registro["prvtel"]."</td>";
            echo "<td>".$registro["prvcont"]."</td>";
            echo "<td>".$registro["prvdir"]."</td>";
            echo "<td>".$registro["prvest"]."</td>";

          }
        }
        ?>
      </table>
    </div>
  </body>
</html>