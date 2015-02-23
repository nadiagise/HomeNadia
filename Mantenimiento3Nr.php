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
    $registro["prdid"] = 0;
    $registro["prddsc"] = $_POST["txtDsc"];
    $registro["prdbrc"] = $_POST["txtbrc"];
    $registro["prdctd"] = $_POST["txtCant"];
    $registro["prdest"] = $_POST["txtDest"];
    $registro["ctgid"] = $_POST["txtCat_id"];
    
 
   
    //Preparar el Insert Statement
    $sqlstr = "INSERT INTO `nw201501`.`productos`(`prdid`,`prddsc`,`prdbrc`,`prdctd`,`prdest`,`ctgid`)";
    $sqlstr .= "VALUES ('" . $registro["prddsc"]  . "',  '". $registro["prdbrc"] ."','" . $registro["prdctd"]  . "','" . $registro["prdest"]  . "','" . $registro["prvdir"]  . "');";
       
     //Ejecutar el Insert Statement
    $result = $conn->query($sqlstr);
    
    //Obtener el último codigo generado
    $lasInsertID= $conn->insert_id;
    
    //Obtener los registros de la tabla
     $sqlQuery  = "Select * from productos;";
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
    <title>Mantenimiento de la tabla Productos</title>
  </head>
  <body>
    <h1>Productos</h1>
    <form action="Mantenimiento3Nr.php" method="POST">
   
        <label for="txtDsc">Descripción</label>
        <input type="text" name="txtDsc" id="txtDsc" />
        <br/>
        <br/>
        <label for="txtbrc">txtbrc</label>
        <input type="text" name="txtbrc" id="txtbrc" />
        <br/>
        <br/>
        <label for="txtCant">Cantidad</label>
        <input type="text" name="txtCant" id="txtCant" />
        <br/>
        <br/>
        <label for="txtDest">txtDest</label>
        <input type="text" name="txtDest" id="txtDest" />
        <br/>
        <br/>
        <label for="txtCat_id">Código Categoría</label>
        <input type="text" name="txtCat_id" id="txtCat_id" />
        <br/>
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
          <th>prdbrc</th>
          <th>Cantidad</th>
          <th>prdest</th>
          <th>Código categoría</th>
          
        </tr>
      <?php
        if(count($registros) > 0){
          foreach($registros as $registro){
            echo "<tr><td>".$registro["prdid"]."</td>";
            echo "<td>".$registro["prddsc"]."</td>";
            echo "<td>".$registro["prdbrc"]."</td>";
            echo "<td>".$registro["prdctd"]."</td>";
            echo "<td>".$registro["prdest"]."</td>";
            echo "<td>".$registro["ctgid"]."</td>";
          

          }
        }
        ?>
      </table>
    </div>
  </body>
</html>