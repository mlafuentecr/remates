<?php   

//toma el tipo de remate que puse en el form
$Typo          = get_field('tipo_de_remate');

?>

<section>
            <div  class="album bg-light">
            <div class="full">
      <a target='blank' href="https://www.rnpdigital.com/shopping/login.jspx;jsessionid=aqt9tOnDczczLFanG62laLDp83oV6_Bm5EL0GNxWL9HlJsbaIQQW!-520219204"> registro </a>
      <a target='blank' href="https://tool-online.com/en/free-map-tools.php"> Cordenadas </a>
      <a target='blank' href="https://www.google.co.cr/maps/place/9%C2%B054'03.5%22N+84%C2%B001'49.7%22W/@9.9008696,-84.0342959,14z/data=!4m5!3m4!1s0x0:0x0!8m2!3d9.9009722!4d-84.0304722?hl=en"> Googlemap </a>
      <a target='blank' href="https://www.waze.com/es/livemap/directions?latlng=9.9280694%2C-84.0907246&utm_campaign=waze_website&utm_source=waze_website"> waze </a>
      </div>
      
            <div   class="album  mainTitle desktop">
                <div class="card-header flexEqual">
                <span class="my-0 font-weight-normal "></span>

                <span class="my-0 font-weight-normal">
                Fecha Remate
               <br>(día/mes/año)	</span>    <!-- DateFormat Y-m-d  d-m-Y -->
                <span id='provincia' class="my-0 font-weight-normal">Provincia</span>
                <span  id='canton' class="my-0 font-weight-normal">Cantón</span>
                <span  id='distrito' class="my-0 font-weight-normal">Distrito</span>
                <span  id='metros' class="my-0 font-weight-normal">M²</span>
                <span  id='base' class="my-0 font-weight-normal">Base</span>
                <span id='penul'  class="my-0 font-weight-normal "></span>
                <span  id='ulti' class="my-0 font-weight-normal "></span>
              </div>
            </div>


      <?php 

    foreach ( $myposts as $post ) : 
      setup_postdata( $post ); 
    
        $postGroup = get_post_meta($id);
      //var_dump($postGroup);
       
      //print_r($valutoPut);
      //update_post_meta( $idPost , $key = 'postgroup_fechadelrematenumeral', $value = $valutoPut );
        $postGroup  = get_field('postgroup', $id); 
        $tipoDeBien = $postGroup['tipo_de_remate'];
        
      ?>
      

      <div class="card-deck  text-center">
      <div class="card shadow-sm">

      <div class="card-header flexEqual">
      <span class="my-0 font-weight-normal">
            <?php  
            if ($tipoDeBien === 'propiedad') { echo '<i class="fa fa-home fa-2x"></i>';
            }

            if ($tipoDeBien === 'vehiculo') { echo '<i class="fa fa-car fa-2x" aria-hidden="true"  style="color:black;" ></i>';
            }

            if ($tipoDeBien === 'motocicleta') { echo '<i class="fa fa-motorcycle fa-2x" aria-hidden="true"></i>';
            }

            if ($tipoDeBien === 'embarcacion') { echo '<i class="fa fa-ship fa-2x" aria-hidden="true"></i>';
            }
            echo '<br><spam class="tipoBien"' . $tipoDeBien . '</spam>';
          ?>
      </span>
      <span class="my-0 font-weight-normal tablet bg_principal"> Fecha Remate<br>(día/mes/año)	</span>
        <span class="my-0 font-weight-normal"><?php echo $postGroup['fechadelrematenumeral']; ?></span>

        <span id='provincia' class="my-0 font-weight-normal tablet bg_principal">Provincia</span>
        <span class="my-0 font-weight-normal"><?php if($Typo=='propiedad'){echo $postGroup['provincia'];}else{echo $postGroup['marca'];} ?></span>
        
        <span  id='canton' class="my-0 font-weight-normal tablet bg_principal">Cantón</span>
        <span class="my-0 font-weight-normal"> <?php  if($Typo=='propiedad'){echo $postGroup['canton'];}else{echo $postGroup['categoria'];} ?></span>

        <span  id='distrito' class="my-0 font-weight-normal tablet bg_principal">Distrito</span>
        <span class="my-0 font-weight-normal"><?php   if($Typo=='propiedad'){echo $postGroup['distrito'];}else{echo $postGroup['carrocería'];} ?></span>

        <span  id='metros' class="my-0 font-weight-normal tablet bg_principal">M²</span>
        <span class="my-0 font-weight-normal"><?php   if($Typo=='propiedad'){echo 'm²'.$postGroup['mide'];}else{echo $postGroup['capacidad'];} ?></span>

        <span  id='base' class="my-0 font-weight-normal tablet bg_principal">Base</span>
        <span class="my-0 font-weight-normal"><?php   if($postGroup['moneda'] == 'colones'){ echo '₡';}else{ echo '$'; }; echo $postGroup['precio_numeral']; ?></span>

        <span  id='base' class="my-0 font-weight-normal tablet bg_principal">Id</span>
        <span class="my-0 font-weight-normal "><?php echo 'ID: '.$postGroup['numero_remate']; ?></span>

        <span  id='base' class="my-0 font-weight-normal tablet bg_principal invisible"></span>
        <span class="my-0 font-weight-normal invisible"></span>
       
      </div>

      <div class="card-body close">
        <div class="detalle">
        <?php 
        echo '<b >Boletin:</b>'.        $postGroup['numero_boletin'];
       
        echo '<b> mide:</b>'.           $postGroup['mide'];
        echo '<b> tipo_de_bien:</b>'.   $postGroup['tipo_de_bien'];
        echo '<b> la_cual_es:</b>'.     $postGroup['la_cual_es'];
        echo '<b> Precio Exacto:</b>'.  $postGroup['precio_largo'];
        echo '<b> gravamenes:</b>'.     $postGroup['gravamenes'];

        echo '<b> matricula:</b>'.      $postGroup['matricula'];
        echo '<b> derecho:</b>'.        $postGroup['derecho'];
        echo '<b> canton:</b>'.         $postGroup['canton'];
        echo '<b> distrito:</b>'.       $postGroup['distrito'];
        echo '<b> provincia:</b>'.      $postGroup['provincia'];
        
       
        echo '<b> rematante:</b>'.      $postGroup['rematante'];
        echo '<b> rematado:</b>'.       $postGroup['rematado'];
        echo '<b> Fecha del Remate:</b>'.$postGroup['fechadelRemate'];
        echo '<b> Hora del Remate:</b>'.  $postGroup['horaremate'];
        echo '<b> juzgado:</b>'.         $postGroup['juzgado'];
        echo '<b> publicacion:</b>'.    $postGroup['publicacion'];
        
        ?>


         <?php echo $postGroup['remateDetalle']; ?>
         
        </div>
        <button type="button" onclick="this.parentNode.classList.toggle('close');" class="btn btn-lg btn-block btn-outline-primary btndetalles">Mas Detalles</button>
      </div>
      </div>
  
    </div>


    <?php endforeach;  ?>
    <?php wp_reset_postdata(); //wp_cache_delete($post_id, 'post_meta');?>
    



  </div>
    </section>
