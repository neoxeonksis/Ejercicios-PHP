<?php

$servername = "localhost";
// El usuario que uséis (este es el que trae por defecto, administrador)
$username = "root";
// Esta contraseña está vacía
$pass = "";
// Nombre de mi base de datos
$database = "uno";

// Create conection
$conn = new mysqli($servername, $username, $pass, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn -> connect_error);
}
else {
    echo "Connected successfully. <br>";
}

if (isset($_GET['DEL'])){
    $b1 = $_GET['DEL'];
    echo "<br> $b1 <br>";
    
    $query = " DELETE FROM artigo
                WHERE id = '$b1'";

    $result4 = $conn -> query("$query");
      
    // Recargar la página cada vez que se pulse un botón
    //  header("Refresh:0");

    
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
    
    #buttons {
        height: 50px;
    }
    #buttons #per-button {
        position: relative;
        margin: -1px;

     

        
        
    }
    #per-button {
        height: 20.4px;
        left: 33.33%;
    }
    #all-table {
        position: relative;
        float: left;
    }
</style>
</head>
<body>
    <h3> SELECT - Artigo</h3>
    
    <input type="button" onclick="location.href='index.html';" value="INDEX"/>
    <input type="button" onclick="location.href='UnoINSERT.php';" value="INSERT"/>
    <input type="button" onclick="location.href='UnoDELETE.php';" value="DELETE"/>

    
    
<form action="UnoSELECT.php" method="GET">
    <p>Escribe asterisco para verlo todo: <input type="text" name="consulta">
    <input type="submit" value="Enviar"></p>
</form>


<?php


    
///////////////////
//////////////////
// Asignamos el asterisco a consulta para que cargue la página con todos los artículos//
    
$_GET['consulta'] = "*";
    
if (isset($_GET['consulta'])) {
    if ($_GET['consulta'] != '*' || $_GET['consulta'] === '' || is_null($_GET['consulta']) === TRUE || empty($_GET['consulta'])) {
        "No se ha escrito un asterisco";
        header('Location: UnoSELECT.php');
        exit;

    }

    else if ($_GET['consulta'] === '*') {
        $query = " SELECT ".$_GET['consulta']. " FROM ARTIGO";

        $result = $conn -> query("$query");
        //$conn -> close();


            echo "<table id='all-table' border=1>";
                echo "<tr>";
                    echo "<th>id_artigo</th>";
                    echo "<th>nome</th>";
                    echo "<th>descripcion</th>";
                    echo "<th>prezo</th>";
                    echo "<th>categoria</th>";
                echo "</tr>";

            while($row = mysqli_fetch_array($result)){
                //$rows[] = mysqli_fetch_array($result);
                echo "<tr>";
                    echo "<td value='count_id'>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nome'] . "</td>";
                    echo "<td>" . $row['descripcion'] . "</td>";
                    echo "<td>" . $row['prezo'] . "</td>";
                    echo "<td>" . $row['categoria'] . "</td>";
                echo "</tr>";
            }
        echo "</table>";
        /* Number of rows
        
        $query2 = "SELECT COUNT(*) as total FROM artigo";
        $result2 = $conn -> query("$query2");
        $data = mysql_fetch_assoc($result2);
        echo "<br> este es el resultado: " . $data['total'] ." <br>";
        var_dump($result2);
        
        
        
        $result2 = mysql_query("SELECT count(*) as total from artigo", $conn);
        $row = mysql_num_rows($result2);
        echo "esto es num filas: $row ";
             */

        

       
 $query3 = " SELECT id FROM artigo LIMIT 1";

        $result = $conn -> query("$query");
        while($row = mysqli_fetch_array($result)){
        $test[] = $row['id'];
        
        
        
        }
    
        
        
        // How many rows? $num
        $query2 = "SELECT * FROM artigo";
        if ($result2 = mysqli_query($conn, $query2)){
            $num = mysqli_num_rows($result2);
 
        }
        echo "<table id='buttons' border=1 >";
        echo "<tr><td>DELETE</td></td>";
        
        
        // For each row ($num)
        for ($i = 0; $i < $num; $i++){
        
    
        echo "
                <form action='' method='GET'>
                
                    <tr>
                        <td><input id='per-button' type= 'submit'
                        name='DEL'  value='"
                            ."$test[$i]".            "' /></td>
                    </tr>
                
                </form>
        ";
        }
        echo "</table>";
    }
}
else {
    echo "<br>No se ha escrito nada";
}

// Asignar a cada botón (button1, button2) que borre
// la id asignada (1, 2)
//

    
    
    
    
    
    
    
    
    
    
    
/**

// Consulta para ver todo lo que hay en tienda
    $query = " SELECT * FROM ARTIGO";

    $result = $conn -> query("$query");
    //$conn -> close();


            echo "<table border=1>";
                echo "<tr>";
                    echo "<th>id_artigo</th>";
                    echo "<th>nome</th>";
                    echo "<th>descripcion</th>";
                    echo "<th>prezo</th>";
                    echo "<th>categoria</th>";
                echo "</tr>";

            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                    echo "<td>" . $row['id_artigo'] . "</td>";
                    echo "<td>" . $row['nome'] . "</td>";
                    echo "<td>" . $row['descripcion'] . "</td>";
                    echo "<td>" . $row['prezo'] . "</td>";
                    echo "<td>" . $row['categoria'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
                // Free result set
            mysqli_free_result($result);
     
     
     
     
     
// Insertar BACKUP tabla con contenidos
// Sin usar COLUMNA id (y convirtiéndola en primary key para el autoincrement)


INSERT INTO `artigo` (`nome`, `descripcion`, `prezo`, `categoria`) VALUES
('Manzana', 'Pieza de fruta verde', 0, 'Alimentos'),
('Silla', 'Cuatro patas con tabla', 15, 'Muebles'),
('Mesa', 'Tabla de madera redonda', 26, 'Muebles'),
('Aspiradora', 'Artefacto para limpiar suelos', 11, 'Electrodomésticos');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `artigo`
--
ALTER TABLE `artigo`
  ADD PRIMARY KEY (`id`);
COMMIT;

*/


?>
    </body>
</html>