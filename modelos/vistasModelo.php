<?php

class vistasModelo {
	protected function obtener_vistas_modelo($vistas) {
		$Lista_Blanca=["consultas","modificacion","registro"];
		$contenido="home";
		if (in_array($vistas, $Lista_Blanca)) {
			if (is_file("./vistas/contenido/".$vistas."-view.php")) {
					$contenido="./vistas/contenido/".$vistas."-view.php";
			} else {
				$contenido="home";
			}
		} elseif($vistas=="index") {
			$contenido="home";
		}
		debug_to_console($contenido);
		return $contenido;
	}
	function debug_to_console( $data ) {
		$output = $data;
		if ( is_array( $output ) )
			$output = implode( ',', $output);

		echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
	}

}
