<?php 


// Gather post data.
$my_post = array(
  'post_title'            => 'My post',
  'post_excerpt'          => '',
  'post_status'           => 'private',
  'post_type'             => 'post', //'post_type' => 'my_custom_post',
  'post_content'          => 'This is my post.',
  'post_status'           => 'publish',
  'post_author'           => 1,
  'post_category'         => array( 8,39 ),
  'meta_input'            => array( //(array) Array of post meta values keyed by their post meta key. Default empty.
    'tipoDeBien'          => 'casa',
    'precio'              => '100,000'
  ),
);



function insetPost($boletinId){
  static $foo_called = false;
  if ($foo_called) return;
  $foo_called = true;


    // unhook this function so it doesn't loop infinitely
    remove_action('save_post', 'insetPost');

    if($boletinId != '' ){
    // update the post, which calls save_post again
    $post_id = wp_insert_post( array( 
      'post_parent'   => 1,
      'post_title'    => $boletinId,
      'post_status'   => 'publish',
      'post_author'   => 1,
      'post_category' => array( 8,39 )
      ) );

      if(!is_wp_error($post_id)){
        //the post is valid
      }else{
        //there was an error in the post insertion, 
        echo $post_id->get_error_message();
      }


    echo ('post it'.$boletinId);

    }else{
      echo ('there is not ids'); 
    }

    // re-hook this function
    add_action('save_post', 'insetPost');




  
   



  
}


function first($int, $string){ //function parameters, two variables.
    return $string;  //returns the second argument passed into the function
  }

  ?>