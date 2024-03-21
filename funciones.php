<?php 

	include "consultas.php";


	function pintaCategorias($defecto) {
		$categorias = getCategorias();

		while($fila = mysqli_fetch_assoc($categorias)){
			if ($fila["CategoryID"] == $defecto){
				echo "<option value='" . $fila["CategoryID"] . "'selected>" . $fila["Name"] . "</option>";
			} else{
				echo "<option value='" . $fila["CategoryID"] . "'>" . $fila["Name"] . "</option>";
			}
		}
	}
	

	function pintaTablaUsuarios(){
		$listaUsuarios = getListaUsuarios();

		echo "<table>\n
				<tr>\n
					<th>Nombre</th>\n
					<th>Email</th>\n
					<th>Autorizado</th>\n
				</tr>\n";

		while ($fila = mysqli_fetch_assoc($listaUsuarios)){
			echo "<tr>\n
					<td>" . $fila['FullName'] . "</td>\n
					<td>" . $fila['Email'] . "</td>\n";

			if ($fila["Enabled"] == 1){
				echo "<td class='rojo'>" . $fila['Enabled'] . "</td>\n";
			} else{
				echo "<td>" . $fila['Enabled'] . "</td>\n";
			}
		}
	}

		
	function pintaProductos($orden) {
		 $productos = getProductos($orden);
        echo '<table>
        <tr>
            <th><a href="articulos.php?orden=ProductID">ID</a></th>
            <th><a href="articulos.php?orden=Name">Nombre</a></th>
            <th><a href="articulos.php?orden=Cost">Coste</a></th>
            <th><a href="articulos.php?orden=Price">Precio</a></th>
            <th><a href="articulos.php?orden=categoria">Categoría</a></th>
            <th>Acciones</th>
        </tr>';
        foreach ($productos as $producto) {
            echo '<tr>
                    <td>'.$producto["ProductID"].'</td>
                    <td>'.$producto["Name"].'</td>
                    <td>'.$producto["Cost"].'</td>
                    <td>'.$producto["Price"].'</td>
                    <td>'.$producto["Categoria"].'</td>';
            if (getPermisos() === 1) {
                echo '<td>
                    <a href="formArticulos.php?q=editar&id='.$producto["ProductID"].'">Editar</a>
                     - 
                    <a href="formArticulos.php?q=borrar&id='.$producto["ProductID"].'">Borrar</a>
                </td>';
            }
            echo '</tr>';
        }
        echo '</table>';
	}
?>