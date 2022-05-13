<?php

/**
 * Plugin name: Traer posts propios
 * Plugin URI: http://ginton.onlinewebshop.net
 * Description: Este plugin se encarga de traer los posts que tiene mi WP
 * Author: Fran Mellado
 * Author URI: http://ginton.onlinewebshop.net
 * version: 0.1.0
 * License: GPL2 or later.
 */

if(isset($_POST['boton'])){
    traerPOSTS();
}

defined('ABSPATH') or die("Jajajaja a donde vas?");

add_action('admin_menu', 'menuPersonalizadoPosts');

function traerPOSTS(){
	$args=array(
            'post_type'=>'post', 
            'post_status'=>'publish', 
            'post_per_page'=>-1
        );
    $query=new WP_Query($args);
	
  	echo '<table border="3">';
    echo '<tr>';
    echo '<td>ID</td>';
    echo '<td>Nombre</td>';
    echo '<td>Autor</td>';
  	echo '<td>Link</td>';
  	echo '<td>Contenido</td>';
    echo '</tr>';
 	
    if ($query->have_posts()) {
      #echo '<ul>';
      
      while ( $query->have_posts() ) {
        echo '<tr>';
        $query->the_post();
        #echo '<li>' . get_the_id() . ' ' . get_the_title() . ' ' . get_the_author() . '</li>';
        echo '<tr><td>' . get_the_id() . '</td><td>' . get_the_title() . '</td><td>' . get_the_author() . '</td><td><a href="' . get_the_permalink() . '">POST</a></td><td>' . get_the_content() . '</td></tr>';
        echo '</tr>';
      }
      #echo '</ul>';
	}else{
    	echo 'No se encontraron posts';
	}
	
  	echo '</table>';
    wp_reset_postdata();
}

function menuPersonalizadoPosts(){
    add_menu_page(
        'Traers posts propios',//page tittle
        'Traers posts propios',//menu tittle
        'manage_options',//capability
        'posts-propios',//menu slug
        'traerPOSTS'//callback function
    );
}
?>