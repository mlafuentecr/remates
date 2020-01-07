<?php /* Template Name: Search */ ?>
<?php 
      acf_form_head(); 
      get_header(); 
     
//date("d/m/Y", strtotime(" -1 week"));
/* The loop */ 
    //con esto imprimo los acf que estan en pg search
    acf_form();
    date_default_timezone_set('America/Costa_Rica'); 
    $remates          = get_field('tipo_de_remate');
    $provincia        = get_field('provincia');
    $idBuscar        = get_field('idBuscar');

    
    $date_now         = date('Y-m-d');
    $fechaBusqueda    = get_field('fecha');
    $fechaDelete      = date("Y-m-d", strtotime(" -1 week"));

    $moneda           = get_field('moneda_choose');
    $precio_colones   = get_field('precio_colones'); ///pueden ser varias opciones
    $precio_dolares   = get_field('precio_dolares');

     
      if($moneda == 'colones'){ 
            $moneda1= '₡'; 
            $precio_a_buscar = $precio_colones;
      }else{ 
            $moneda1= 'S'; 
            $precio_a_buscar = $precio_dolares;
      }


      define("MONEDA",        $moneda );
      define("TYPO",          $remates );

      define("FECHANow",      $date_now);
      define("FECHABusqueda", $fechaBusqueda );
      define("FECHADelete",   $fechaDelete);

      define("PROVINCIA",     $provincia );
      define("PRECIO",        $precio_a_buscar );
      

   // print_r( $provincia );
    // echo  ' xx'.$precio_a_buscar.'   '.$remates.' fecha now:> '.FECHANow.' FECHABusqueda:> '.FECHABusqueda.' delete >'.FECHADelete.'<br>';




$argPropiedad = array(
      'posts_per_page' => -1,
      'meta_key'       => 'postgroup_fechadelrematenumeral',
      'meta_value'     => $fechaBusqueda, 
      'meta_compare'   => '<',

      'meta_query'       => array(
            'relation'    => 'AND',
            array(
                'key'          => 'postgroup_moneda',
                'value'        => $moneda,
                'compare'      => '=',
            ),
            array(
                  'key'          => 'postgroup_tipo_de_remate',
                  'value'        => $remates, 
                  'compare'      => '=',
              ),
            array(
                  'key'          => 'postgroup_provincia',
                  'value'        => $provincia, 
                  'compare'      => 'IN'
              ),
              array(
                  'key'          => 'postgroup_precio_numeral',
                  'value'        => $precio_a_buscar, 
                  'compare'      => '<',
                  'type' => 'numeric' 
              )
      )
 
);

$argOtros = array(
      'posts_per_page' => -1,
      'meta_key'       => 'postgroup_fechadelrematenumeral',
      'meta_value'     => $fechaBusqueda, 
      'meta_compare'   => '<',

      'meta_query'       => array(
            'relation'    => 'AND',
            array(
                'key'          => 'postgroup_moneda',
                'value'        => $moneda,
                'compare'      => '=',
            ),
            array(
                  'key'          => 'postgroup_tipo_de_remate',
                  'value'        => $remates, 
                  'compare'      => '=',
            ),
              array(
                  'key'          => 'postgroup_precio_numeral',
                  'value'        => $precio_a_buscar, 
                  'compare'      => '<',
                  'type'         => 'numeric' 
              )
      )
 
);

$argDelete= array(
      'posts_per_page' => -1,
      'cat'            =>  1,
      'meta_key'       => 'postgroup_fechadelrematenumeral',
      'meta_value'     => $fechaDelete, 
      'meta_compare'   => '<',
);

$argPost= array(
      'posts_per_page' => -1,
      'name' => $idBuscar
      
);



if ($idBuscar !== '') {
      $args  = $argPost;  
      echo 'xon id'; 
}elseif ($remates === 'propiedad'){
      echo 'sin id propiedad'; 
      $args  = $argPropiedad;   
}else{
      echo 'sin id otro'; 
      $args  = $argOtros;   
}



$RemateSettings_group   = get_field("btns", $GLOBALS['rematesPg']);  
$borrarAction           = $RemateSettings_group['borrar_post_viejos'];  


/* resultado del search */
$myposts          = get_posts( $args );
if( $myposts ) {
      require   $GLOBALS['themePath'].'/querySearch.php';
}




// The Query delete
$queryDelete = new WP_Query( $argDelete );
 
if($borrarAction){
      // The Loop
      while ( $queryDelete->have_posts() ) {
      $queryDelete->the_post();
      wp_trash_post($id, true);
      echo '<li>borrando: ' . get_the_title(). ' id:'.$id . '</li>';
      }

      wp_reset_postdata();
}
 // //       //wp_delete_post(get_the_ID(), true);
// //       //wp_trash_post($id, true);


/* The 2nd Query (without global var) */
// $query2 = new WP_Query( $args );
 
// // The 2nd Loop
// while ( $query2->have_posts() ) {
//     $query2->the_post();
//     echo '<li>' . get_the_title( $query2->post->ID ) . '</li>';
// }
 
// // Restore original Post Data
// wp_reset_postdata();

































    

      
      //add_action( 'init', 'delete_expired' );
      //delete_expired();
      
 

?>


 

<script>
 jQuery(document).ready(function($) {
     
       //on click wrap  pone date en input date 
       $("#acf-field_5dfbceb8eccf6").click(function(){
      $date1 = $("#acf-field_5dfbceb8eccf6").datepicker({ dateFormat: 'yy-mm-dd' });   //* DateFormat Y-m-d  d-m-Y
     });


//      $("input.acf-button").click(function(){
//          alert('sss');
//      });

     //abre funcion de esconder precio que no se ocupe
     HideCurrency($);
     HideProvincey($);

     //si currency cambia cambie precios
     $("#acf-field_5dfc057b6ef0e").change(function(){
         HideCurrency($);
     });

   //si currency cambia cambie precios
   $("#acf-field_5dfc0050fa209").change(function(){
         HideProvincey($);
     });


 });//Jquery ready 


//funcion esconde o muestra colones o dolares
  var HideCurrency = function($) { 
          if($("#acf-field_5dfc057b6ef0e").val() === 'colones'){
          //muestre colones .acf-field-5dfc0f4f20731
          $(".acf-field-5dfc0f4f20731").show();
          $(".acf-field-5dfc1053f64fd").hide();
          }else{
          //muestre dolares
          $(".acf-field-5dfc1053f64fd").show();
          $(".acf-field-5dfc0f4f20731").hide();
          }
  };


  var HideProvincey = function($) { 
       
          if($("#acf-field_5dfc0050fa209").val() === 'propiedad'){
          //muestre colones .acf-field-5dfc0f4f20731
          $(".acf-field-5dfbba7a7e45b").show();
          $("#provincia").text( "provincia" );
          $("#canton").text( "Canton" );
          $("#distrito").text( "Distrito" );
          $("#metros").text( "M²" );
          }else{
          //hide propieda
          $(".acf-field-5dfbba7a7e45b").hide();
          $("#provincia").text( "Marca" );
          $("#canton").text( "Categoria" );
          $("#distrito").text( "Carroceria" );
          $("#metros").text( "capacidad" );
          
          }
  };


</script>



<?php get_footer(); ?>