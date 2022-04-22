<?php
/**
 * Plugin name: Prueba Shottcodes
 * Plugin URI: https://franpruebas.x10.mx
 * Description: Prueba de traer informacion de una API externa con shortcodes
 * Author: Fran Mellado
 * Author URI: https://franpruebas.x10.mx
 * version: 0.1.0
 * License: GPL2 or later.
 */

defined( 'ABSPATH' ) or die( 'Acceso denegado' );

add_shortcode('traer_datos', 'callback_function_name');

function callback_function_name(){
    //return 'Esto se muestra correctamente';

    $url='https://jsonplaceholder.typicode.com/users';
    $arguments=array(
        'method'=>'GET',
    );

    $response=wp_remote_get($url, $arguments);
    if(is_wp_error($response)){
        $error_message=$response->get_error_message();
        return "Algo ha salido mal: $error_message";
    }

    //Si quiero mostrarlo sin tabla
    /*echo '<pre>';
        $body= wp_remote_retrieve_body($response);
		var_dump($body);
    echo '</pre>';*/

    //Si quiero mostrarlo en una tabla

    $results=json_decode(wp_remote_retrieve_body($response));
  
 	//$var_dump($results);

    $html='';
    $html.='<table border="2">';
    $html.='<tr>';
    $html.='<td>id</td>';
    $html.='<td>Name</td>';
    $html.='<td>Username</td>';
    $html.='<td>Email</td>';
    $html.='<td>Address</td>';
    $html.='</tr>';

    foreach($results as $result){
        $html.='<tr>';
        $html.='<td>'.$result->id.'</td>';
        $html.='<td>'.$result->name.'</td>';
        $html.='<td>'.$result->username.'</td>';
        $html.='<td>'.$result->email.'</td>';
        $html.='<td>'.$result->address->street.', '.$result->address->suite.', '.$result->address->city.', '.$result->address->cityzipcode.'</td>';
        $html.='</tr>'; 
    }
  	$html.='</table>';

    return $html;

}

?>