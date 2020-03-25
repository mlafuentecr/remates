<?php /* Template Name: page List */ ?>
<?php 

get_header(); 

$posts = get_posts(array(
  'numberposts'	=> -1,
  'category' => 1,
  'meta_query' => array(
		array(
			'key' => 'postgroup_tipo_de_bien',
			'value'   => array( 'Propiedad' )
		)
	)
));


if( $posts ): ?>



<section>
    <div  class="album py-5 bg-light">
    <div   class="album  mainTitle">
        <div class="card-header flexEqual">
        <span class="my-0 font-weight-normal">
        Fecha Remate
        <br>(día/mes/año)	</span>
        <span class="my-0 font-weight-normal">Provincia</span>
        <span class="my-0 font-weight-normal">Cantón</span>
        <span class="my-0 font-weight-normal">Distrito</span>
        <span class="my-0 font-weight-normal">M²</span>
        <span class="my-0 font-weight-normal">Base</span>
        <span class="my-0 font-weight-normal ">Free</span>
        <span class="my-0 font-weight-normal ">Free</span>
      </div>
      </div>




<?php foreach( $posts as $post ): 

// $meta = get_post_meta(get_the_ID(), '', true);
// print_r($meta);

setup_postdata( $post );


$postGroup = get_field('postgroup', $post->ID); 




?>






<div class="card-deck  text-center">
    <div class="card shadow-sm">

      <div class="card-header flexEqual">
        <span class="my-0 font-weight-normal"><?php echo $postGroup['fechadelrematenumeral']; ?></span>
        <span class="my-0 font-weight-normal"><?php echo $postGroup['provincia']; ?></span>
        <span class="my-0 font-weight-normal"><?php echo $postGroup['canton']; ?></span>
        <span class="my-0 font-weight-normal"><?php echo $postGroup['distrito']; ?></span>
        <span class="my-0 font-weight-normal"><?php echo $postGroup['mide']; ?></span>
        <span class="my-0 font-weight-normal"><?php echo $postGroup['currency'].$postGroup['precio_numeral']; ?></span>
        <span class="my-0 font-weight-normal invisible">Free</span>
        <span class="my-0 font-weight-normal invisible">Free</span>
      </div>

      <div class="card-body close">
        <div class="detalle   ">
        <?php 
        echo '<b >Boletin:</b>'.$postGroup['numero_boletin'];
      
       
        echo '<b> mide:</b>'.$postGroup['mide'];
        echo '<b> tipo_de_bien:</b>'.$postGroup['tipo_de_bien'];
        echo '<b> la_cual_es:</b>'.$postGroup['la_cual_es'];
        echo '<b> Precio Exacto:</b>'.$postGroup['currency'].$postGroup['precio_largo'];
        echo '<b> gravamenes:</b>'.$postGroup['gravamenes'];

        echo '<b> matricula:</b>'.$postGroup['matricula'];
        echo '<b> derecho:</b>'.$postGroup['derecho'];
        echo '<b> canton:</b>'.$postGroup['canton'];
        echo '<b> distrito:</b>'.$postGroup['distrito'];
        echo '<b> provincia:</b>'.$postGroup['provincia'];
        
        echo '<b> rematante:</b>'.$postGroup['rematante'];
        echo '<b> rematado:</b>'.$postGroup['rematado'];
        echo '<b> Fecha del Remate:</b>'.$postGroup['fechadelRemate'];
        echo '<b> Hora del Remate:</b>'.$postGroup['horaremate'];
        echo '<b> juzgado:</b>'.$postGroup['juzgado'];
        echo '<b> publicacion:</b>'.$postGroup['publicacion'];
        
        ?>


         <?php echo $postGroup['remateDetalle']; ?>
         
        </div>
        <button type="button" onclick="this.parentNode.classList.toggle('close');" class="btn btn-lg btn-block btn-outline-primary btndetalles">Mas Detalles</button>
      </div>
      </div>
    </div>
   
















	<?php endforeach; ?>
  </div>
    </section>
	
	<?php wp_reset_postdata(); ?>
<?php endif; ?>



  

   
  

  
 


    
<?php get_footer(); ?>