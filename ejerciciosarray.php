<?php 
	$arreglo = [
		'keyStr1' => 'lado',
		0 => 'ledo',
		'keyStr2' => 'lido',
		1 => 'lodo',
		2 => 'ludo'
	];

	echo "<h3>Ejercicio 1</h3>";
	echo "$arreglo[keyStr1], $arreglo[0], $arreglo[keyStr2], $arreglo[1], $arreglo[2]<br>";
	echo "decirlo al revés lo dudo<br> ";
	echo "$arreglo[2], $arreglo[1], $arreglo[keyStr2], $arreglo[0], $arreglo[keyStr1]<br>";
	echo "¡Qué trabajo me ha costado!";
	echo "<br>";
	echo "<hr>";

	$ejercicio2 = [
	    'Mexico' => [
	      'Monterrey', 'Queretaro', 'Guadalajara'
	    ],
	    'Colombia' => [
	      'Bogota', 'Cartagena', 'Medellin'
	    ],
	    'Peru' => [
	      'Lima', 'Arequipa', 'Cuzco'
	    ],
	    'Chile' => [
	      'Santiago', 'Chillán', 'Punta Arenas'
	    ],
	    'Venezuela' => [
	      'Caracas', 'Valencia', 'Maracay'
	    ]
 	];

 	foreach ($ejercicio2 as $pais => $ciudades) {
 		echo "<br> El pais $pais tiene como ciudades a ";
 		foreach ($ciudades as $ciudad) {
 			echo $ciudad.', ';
 		}
 	}

 	echo "<br>";
	echo "<hr>";

	$ejercicio3 = [23, 54, 32, 67, 34, 78, 98, 56, 21, 34, 57, 92, 12, 5, 61];
	rsort($ejercicio3); // Acomoda el arrego de mayor a menor
	echo "<br>";
	echo "Los tres valores mas altos son: ";

	for ($i=0; $i < 3; $i++) { 
		echo "$ejercicio3[$i] ";
	}

	echo "<br>";
	echo "Los tres valores mas bajos son: ";

	sort($ejercicio3);
	for ($i=0; $i < 3; $i++) { 
		echo " ".$ejercicio3[$i];
	}

?>