<?php 

//*invoice / receipt dropdown yiannis
add_action('woocommerce_before_order_notes', 'wps_add_select_checkout_field');
function wps_add_select_checkout_field( $checkout ) {
	echo '<h2>'.__('Απόδειξη Λιανικής/Τιμολόγιο').'</h2>';
	woocommerce_form_field( 'parastatiko', array(
	    'type'          => 'select',
	    'class'         => array( 'wps-drop' ),
		'required'  	=> true,
	    'label'         => __( 'Επιλογή παραστατικού' ),
	    'options'       => array(
	    	'blank'		=> __( 'Επιλέξτε', 'wps' ),
	        'receipt'	=> __( 'Απόδειξη Λιανικής', 'wps' ),
	        'invoice'	=> __( 'Τιμολόγιο', 'wps' )
	    )
 ),
	$checkout->get_value( 'parastatiko' ));
}
add_action('woocommerce_checkout_process', 'wps_select_checkout_field_process');
function wps_select_checkout_field_process() {
	global $woocommerce;
	// elegxos egkurotitas, provoli mhnumatos sfalmatos.
	if ($_POST['parastatiko'] == "blank")
		wc_add_notice( 'Παρακαλώ επιλέξτε το νόμιμο παραστατικό που επιθυμείτε για την αγορά <strong>(Απόδειξη Λιανικής/Τιμολόγιο)</strong>', 'error' );
}
//*emfanisi stoixeiwn tou dropdown stin paraggelia + ta emails
add_action('woocommerce_checkout_update_order_meta', 'wps_select_checkout_field_update_order_meta');
 function wps_select_checkout_field_update_order_meta( $order_id ) {
   if ($_POST['parastatiko']) update_post_meta( $order_id, 'parastatiko', esc_attr($_POST['parastatiko']));
 }
 
 add_action( 'woocommerce_admin_order_data_after_billing_address', 'wps_select_checkout_field_display_admin_order_meta', 10, 1 );
function wps_select_checkout_field_display_admin_order_meta($order){
	echo '<p><strong>'.__('Παραστατικό:').':</strong> ' . get_post_meta( $order->id, 'parastatiko', true ) . '</p>';
}
//* Add selection field value to emails
add_filter('woocommerce_email_order_meta_keys', 'wps_select_order_meta_keys');
function wps_select_order_meta_keys( $keys ) {
	$keys['Parastatiko:'] = 'parastatiko';
	return $keys;
	
}

//* afm textbox
add_action('woocommerce_before_order_notes', 'wps_add_parastatikoInfo_checkout_field');
function wps_add_parastatikoInfo_checkout_field( $checkout ) {
	/*echo '<h2>'.__('Τιμολόγιο | Εισαγωγή Στοιχείων').'</h2>';*/
	woocommerce_form_field( 'parastatikoInfo', array(
	    'type'          => 'textarea',
	    'class'         => array( 'notes' ),
		'required'  	=> true,
	    'label'         => __( 'Στοιχεία Εταιρείας, ΑΦΜ, ΔΟΥ' ),
	    'placeholder' 	=> _x('Εισαγωγή Στοιχείων Εταιρείας, ΑΦΜ, ΔΟΥ.', 'placeholder', 'woocommerce')
        
 ),
	$checkout->get_value( 'parastatikoInfo' ));
}
add_action('woocommerce_checkout_process', 'wps_parastatikoInfo_checkout_field_process');
function wps_parastatikoInfo_checkout_field_process() {
	global $woocommerce;
	// elegxos egkurotitas, provoli mhnumatos sfalmatos.
	if ($_POST['parastatikoInfo'] == "blank")
		wc_add_notice( 'Παρακαλώ εισάγετε ΑΦΜ, ΔΟΥ και τα απαραίτητα στοιχεία της επιχείρισής σας για την έκδοση <strong>Τιμολογίου</strong>', 'error' );
}
//*emfanisi stoixeiwn tou dropdown stin paraggelia + ta emails
add_action('woocommerce_checkout_update_order_meta', 'wps_parastatikoInfo_checkout_field_update_order_meta');
 function wps_parastatikoInfo_checkout_field_update_order_meta( $order_id ) {
   if ($_POST['parastatikoInfo']) update_post_meta( $order_id, 'parastatikoInfo', esc_attr($_POST['parastatikoInfo']));
 }
 
 add_action( 'woocommerce_admin_order_data_after_billing_address', 'wps_parastatikoInfo_checkout_field_display_admin_order_meta', 10, 1 );
function wps_parastatikoInfo_checkout_field_display_admin_order_meta($order){
	echo '<p><strong>'.__('Στοιχεία Παραστατικού:').':</strong> ' . get_post_meta( $order->id, 'parastatikoInfo', true ) . '</p>';
}
//* Add selection field value to emails
add_filter('woocommerce_email_order_meta_keys', 'wps_select_order_meta_keys2');
function wps_select_order_meta_keys2( $keys ) {
	$keys['ParastatikoInfo:'] = 'parastatikoInfo';
	return $keys;
	
}