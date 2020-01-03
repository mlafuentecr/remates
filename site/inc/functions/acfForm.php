<?php
add_action('acf/save_post', 'my_save_post');

function my_save_post( $post_id ) {
    echo 'deberia imprimir form';
    
	// bail early if not a contact_form post
	if( get_post_type($post_id) !== 'contact_form' ) {
		
		return;
		
	}
	
	
	// bail early if editing in admin
	if( is_admin() ) {
		
		return;
		
	}
	
	
	// vars
	$post = get_post( $post_id );
	
	
	// get custom fields (field group exists for content_form)
	$name = get_field('name', $post_id);
	$email = get_field('email', $post_id);
	
	
	// email data
	$to = 'contact@website.com';
	$headers = 'From: ' . $name . ' <' . $email . '>' . "\r\n";
	$subject = $post->post_title;
	$body = $post->post_content;
	
	
	// send email
	wp_mail($to, $subject, $body, $headers );
	
}

?>