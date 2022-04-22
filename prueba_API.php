<?php
//Comentarios obligatorios para crear un plugin
/**
 * Plugin name: Prueba API TechiePress
 * Plugin URI: http://ginton.onlinewebshop.net
 * Description: Prueba de traer informacion de una API externa
 * Author: Fran Mellado
 * Author URI: http://ginton.onlinewebshop.net
 * version: 0.1.0
 * License: GPL2 or later.
 */


//Con esta linea de codigo hacemos que no puedan accerder a un archivo por la URL
defined( 'ABSPATH' ) or die( 'Acceso denegado' );

add_action('admin_menu', 'mostrar_informacionAPI');

//Menu del plugin
function mostrar_informacionAPI(){
add_menu_page(
	'Datos API',//page tittle
	'Datos API',//menu tittle
	'manage_options',//capability
	'datos-api',//menu slug
	'traer_informacionAPI'//callback function
);
}

function traer_informacionAPI(){
	//echo "hola";
	$url='https://api.sampleapis.com/wines/reds';
	$arguments=array(
			'method' => 'GET'
	);
	
	//echo "Llego sano y salvo";
$response=wp_remote_get($url, $arguments);
	
	//echo "SIP";
if(is_wp_error($response)){
	//echo "Entro al error";
	$msg_error=$response->get_error_message();
	echo $msg_error;
}else{
	//echo "Llego";
	echo '<pre>';
	$body=wp_remote_retrieve_body($response);
	var_dump($body);
	//var_dump(wp_remote_retrieve_body(json_decode($response)));
	echo '</pre>';
	}
}

//Prueba para ver si esta mal el menu o la funcion
function pruebaImprimir(){
	echo "SI";
}
?>