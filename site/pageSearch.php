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

    
    $date_now         = date('d-m-Y');
    $fechaBusqueda    = get_field('fecha');
    $fechaDelete      = date("d-m-Y", strtotime(" -1 week"));

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
      

    print_r( $provincia );
    
      echo  $remates.' fecha now:> '.FECHANow.' FECHABusqueda:> '.FECHABusqueda.' delete >'.FECHADelete.'<br>';

 

   


// $argDate = array(
//       'posts_per_page' => -1,
//       'meta_key'       => 'postgroup_fechadelrematenumeral',
//       'meta_value'     => FECHABusqueda, 
//       'meta_compare'   => '<',
 
// );


$argPropiedad = array(
      'posts_per_page' => -1,
     
 
      'meta_key'       => 'postgroup_fechadelrematenumeral',
      'meta_value'     => FECHABusqueda, 
      'meta_compare'   => '<',

      'meta_query'       => array(
            'relation'    => 'AND',
            array(
                'key'          => 'postgroup_moneda',
                'value'        => MONEDA,
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
      )
 
);

$argOtros = array(
      'posts_per_page' => -1,
     
 
      'meta_key'       => 'postgroup_fechadelrematenumeral',
      'meta_value'     => FECHABusqueda, 
      'meta_compare'   => '<',

      'meta_query'       => array(
            'relation'    => 'AND',
            array(
                'key'          => 'postgroup_moneda',
                'value'        => MONEDA,
                'compare'      => '=',
            ),
            array(
                  'key'          => 'postgroup_tipo_de_remate',
                  'value'        => $remates, 
                  'compare'      => '=',
              )
      )
 
);

if($remates === 'propiedad'){
      $args  = $argPropiedad;   
}else{
      $args  = $argOtros;   
}





$myposts          = get_posts( $args );
if( $myposts ) {
      require   $GLOBALS['themePath'].'/querySearch.php';
}




if( $mypostsTest ) {
foreach ( $myposts as $post ) : 

      // modify the $post variable with the post data you want.
      setup_postdata( $post );  
 
      echo $id.' ';
      $postGroup = get_post_meta($id);
     // var_dump($postGroup);
      echo '<b> Fecha del Remate:</b>'.$postGroup['postgroup_fechadelrematenumeral'][0].'<br>';
      // $valutoPut = $postGroup['postgroup_fechadelrematenumeral'][0];
endforeach;

wp_reset_postdata(); //wp_cache_delete($id, 'post_meta');
      }
 




//$posts         = new WP_Query( $argsRefresh  );
//  update_post_meta( $post_id , $key = 'postgroup_fechadelrematenumeral', $value = $value['postgroup_fechadelrematenumeral'] );





      //add_action( 'init', 'delete_expired' );
      //delete_expired();
      
      //DELTE POST
      function delete_expired() {
           


            if ($the_query->have_posts()):
                while($the_query->have_posts()): $the_query->the_post();      
                echo 'delete ';
                    //wp_delete_post(get_the_ID(), true);
                    wp_trash_post(get_the_ID(), true);
        
                endwhile;
            endif;
        }

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