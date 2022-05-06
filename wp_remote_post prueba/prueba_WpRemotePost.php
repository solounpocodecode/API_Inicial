<?php
/**
 * Plugin name: Prueba Post hacia la API
 * Plugin URI: http://ginton.onlinewebshop.net
 * Description: Prueba de wp_remote_post
 * Author: Fran Mellado
 * Author URI: http://ginton.onlinewebshop.net
 * version: 0.1.0
 * License: GPL2 or later.
 */

//Conseguir fecha y hora actual
$DateAndTime = date('m-d-Y h:i:s a', time());

if(isset($_POST['prueba'])){
    WpRemotePost();
}

//Datos normales
$id=11;
$date_created=$DateAndTime;
$date_created_gmt=$DateAndTime;
$date_modified=$DateAndTime;
$date_modified_gmt=$DateAndTime;
$email="frmm345@gmail.com";
$first_name="Fran";
$last_name="Mellado Martínez";
$role="";
$username="fran.mellado";

//Datos "billing"
$billing_first_name="Fran";
$billing_last_name="Mellado Martínez";
$billing_company="";
$billing_address_1="Jesus Gomez Ballester Nº7 1ºG";
$billing_address_2="";
$billing_city="Callosa de segura";
$billing_phone="";

//Datos "shipping"
$shipping_first_name="Fran";
$shipping_last_name="Mellado Martinez";
$shipping_company="";
$shipping_address_1="Jesus Gomez Ballester Nº7 1ºG";
$shipping_address_2="";
$shipping_city="Callosa de segura";
$shipping_postcode="03360";
$shipping_country="Spain";
$shipping_state="A";
$shipping_phone="";

//Datos extra
$is_paying_customer=true;
$avatar_url="https://secure.gravatar.com/avatar/cec764abba76876e8d8fea8f9e6a7190?s=96&d=mm&r=g";

//Datos metadata

//Datos links
$linkCustomer='https://staging-o.ammarket.com/wp-json/wc/v3/customers/' . $id . '/';
$linkColeccion='https://staging-o.ammarket.com/wp-json/wc/v3/customers/';

//Comprobar si es corrector usar 'admin_init' (y comprobar que no se revienta la pagina xD) o crear un menu personalizado para esta wea.
add_action('admin_menu', 'menuPersonalizado');

//WP_REMOTE_POST
function WpRemotePost(){
    $url = 'https://staging-o.ammarket.com/wp-json/wc/v3/customers/';
    $response = wp_remote_post( $url, array(
        'method' => 'post',
        'headers' => array(
            'Authorization' => 'Basic ' . base64_encode( ck_1b91f0b63788ceb6da7923046c2e8024b984d3d1 . ':' . cs_a4049600477052fd58bf4139f503444bc840fd20 )
        ),
        'body' => json_encode(
                array( 
                    'id' => $id,
                    'date_created' => $date_created,
                    'date_created_gmt' => $date_created_gmt,
                    'date_modified' => $date_modified,
                    'date_modified_gmt' => $date_modified_gmt,
                    'email' => $email,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'role'  => $role,
                    'username' => $username,

                    'billing' => array(
                        'first_name' => $billing_first_name,
                        'last_name' => $billing_last_name,
                        'company' => $billing_company,
                        'address_1' => $billing_address_1,
                        'address_2' => $billing_address_2,
                        'city' => $billing_city,
                        'phone'=> $billing_phone
                    ),

                    'shipping' => array(
                        'first_name' => $shipping_first_name,
                        'last_name' => $shipping_last_name,
                        'company' => $shipping_company,
                        'address_1' => $shipping_address_1,
                        'address_2' => $shipping_address_2,
                        'city' => $shipping_city,
                        'postcode' => $shipping_postcode,
                        'country' => $shipping_country,
                        'state' => $shipping_state,
                        'phone' => $shipping_phone
                    ),

                    'is_paying_customer' => $is_paying_customer,
                    'avatar_url' => $avatar_url,

                    'meta_data' => array(
                        array(
                            'id' => 456,
                            'key' => '_wcs_subscription_ids_cache',
                            'value' => array(
                                19291
                            )
                        ),
                        array(
                            'id' => 457,
                            'key' => '_yoast_wpseo_profile_updated',
                            'value' => '22212323212'
                        ),
                        array(
                            'id' => 458,
                            'key' => 'icl_admin_language',
                            'value' => 'es'
                        ),
                        array(
                            'id' => 459,
                            'key' => 'shipping_method',
                            'value' => array(
                                '0' => 'flexible_shipping_single:3',
                                '2021_11_13_daily_for_3_days_0' => 'flexible_shipping_single'
                            )
                        ),
                        array(
                            'id' => 460,
                            'key' => 'billing_dni',
                            'value' => '21/04/1978'
                        ),
                        array(
                            'id' => 461,
                            'key' => 'billing_mobile_phone',
                            'value' => ''
                        ),
                        array(
                            'id' => 461,
                            'key' => 'shipping_mobile_phone',
                            'value' => ''
                        ),
                        array(
                            'id' => 462,
                            'key' => 'wc_last_active',
                            'value' => '1234567890'
                        ),
                        array(
                            'id' => 463,
                            'key' => 'woodmart_wishlist_4',
                            'value' => array(
                                'expires' => '0987654321',
                                'products' => array()
                            )
                        ),
                        array(
                            'id' => 464,
                            'key' => 'icl_admin_language_migrated_to_wp47',
                            'value' => '1'
                        ),
                        array(
                            'id' => 465,
                            'key' =>  'ppcp-vault-token',
                            'value' => array()
                        )
                    ),

                    '_links' => array(
                        'self' => array(
                            'href' => $linkCustomer
                        ),
                        'collection' => array(
                            'href' => $linkColeccion
                        )
                    )
                ) 
            )                       
        )
    );

    //$body=json_decode($response['body']);
    //print_r($body);

    //Recibe el mensaje de estado(200, 300, 401, 404, 500) y en caso de que salga bien no los imprime en pantalla
    if(wp_remote_retrieve_response_message($response)==='Created'){
        echo 'El cliente ' . $body . ' ha sido creado correctamente';
    }else{
        echo "Ha ocurrido un error";
    }
}

function formularioBoton(){
    echo "
        <span>Prueba de mandar datos a la API</span>
        <form action='' method='POST'>
            <input type='submit' value='boton' name='prueba'/>
        </form>
    ";
}

function menuPersonalizado(){
    add_menu_page(
        'Prueba API POST',//page tittle
        'Prueba API POST',//menu tittle
        'manage_options',//capability
        'api-post',//menu slug
        'formularioBoton'//callback function
    );
}
?>

