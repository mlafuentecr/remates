<?php

/*--------------------------------------------------------------
>>> Busco el contenido PDF cada vez que salvo la pagina pdf
----------------------------------------------------------------*/
/*
Remates
Títulos Supletorios
Citaciones
Avisos
 */




if ( ! is_admin() ) {

    require  $GLOBALS['themePath'].'/inc/functions/CPT_Utilities.php';
    date_default_timezone_set('America/Costa_Rica');
    require_once( ABSPATH . 'wp-admin/includes/post.php' );
}


//Get info from ACF load pdf field $GLOBALS['rematesPg'] is the id from functions
$pdfInfo = get_field("load_pdf", $GLOBALS['rematesPg']);

$pdfInfo = strtolower($pdfInfo); 


//saco el numero de bolentin
//  if (stripos($pdfInfo, 'boletÍn judicial') !== false) {
//     global $boletinNumber;
//     $boletinNumber = explode('boletÍn judicial', $pdfInfo);
//     $boletinNumber = explode('del', $boletinNumber[1]);
//     $boletinNumber = str_replace("n°", "", $boletinNumber);
//     $boletinNumber = $boletinNumber[0];
     
// }


$boletinNumberACF  = get_field( "numero_boletin" , $GLOBALS['rematesPg']);

if( $boletinNumberACF === '' || $boletinNumberACF === null  ) {
    wp_die(print_r('Boletin esta vacio'));
}else{
    //wp_die(print_r($boletinNumberACF));
}
global $boletinNumber;
$boletinNumber = $boletinNumberACF;






//divido en pedasos todo el texto 
 if (stripos($pdfInfo, 'segunda publicaciÓn') !== false || stripos($pdfInfo, 'SEGUNDA PUBLICACIÓN') !== false) {

    $strPubli = 'SEGUNDA PUBLICACIÓN|segunda publicaciÓn|PRIMERA PUBLICACIÓN|primera publicaciÓn';
    $blockRemates = preg_split('/' . $strPubli . '/i', $pdfInfo, 0, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    unset($blockRemates[0]); //saco el bloque 0 y segundapublicacion empieza en [1]
    
    split_variables_remates($blockRemates[1], 'segunda');
    split_variables_remates($blockRemates[2], 'primera');

}else{

    $strPubli = 'PRIMERA PUBLICACIÓN|primera publicaciÓn';
    $blockRemates = preg_split('/' . $strPubli . '/i', $pdfInfo, 0, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    unset($blockRemates[0]); //saco el bloque 0 y segundapublicacion empieza en [1]
    split_variables_remates($blockRemates[1], 'primera');
}





function split_variables_remates($info, $publi)
{
    $RemateSettings_group   = get_field("btns", $GLOBALS['rematesPg']);  
    $postRemates           = $RemateSettings_group['mostrar_o_postear']; 
    $verDetalles           = $RemateSettings_group['ver_detalles']; 


    
    global $publicacion;
    global $precio;
    global $precioShort;
    global $moneda;
    global $gravamenes;
    global $tipo_De_Remate;
    global $matricula;
    global $derecho;
    global $distrito;
    global $canton;
    global $provincia;
    global $mide;
    global $laCuales;

    global $marca;
    global $categoria;
    global $carrocería;
    global $capacidad;

    global $plano;
    global $rematante;
    global $rematado;
    global $juzgado;
    global $expediente;

    global $fechadelRemate;
    global $fechadelRemateNumeral;
    global $horaRemate;


    global $remateDetalle;
    global $remateDetalleTest;

    global $rematesTotal;
    global $remateIdNumber;
    global $remateNumber;
    
   
    $boletinNumber = $boletinNumberACF;


    if($publi == 'primera'){
        $publicacion = 'Primera publicación';
    }else{
        $publicacion = 'Segunda publicación';
    }
    
    $info = strtolower($info);

    $str = 'En este Despacho,|En la puerta exterior|de primer remate de ';
    $blockRemates = preg_split('/' . $str . '/i', $info, 0, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

    if (strlen($blockRemates[0]) < 20 || $blockRemates[0] == '' || $blockRemates[0] == '') {unset($blockRemates[0]);}
    $rematesTotal = count($blockRemates);
     //var_dump($rematesTotal);
  


    //Cada remate separado count($blockRemates)
    for ($i = 1; $i < $rematesTotal; $i++) {


        $str = "/(En la puerta exterior de este Despacho;|capacidad|marca|carrocería|categoría| con la base|En este Despacho, |;|,|sáquese a remate|la cual es|distrito|provincia|con una base| De no haber postores|así en proceso|contra|Expediente|—Juzgado de|plano:|Mide:|Colinda:|cantón|se señalan las |.—)/";
        $str = strtolower($str);
        $remateArray = preg_split($str, $blockRemates[$i], 0, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        // // //Limpio de ;
        $remateArray = array_filter($remateArray, function ($string) {
            return strpos($string, ';') === false;
        });

     
        //Detalle
       $remateDetalle = $blockRemates[$i];
       if($verDetalles){
        $remateDetalleTest = $remateArray;
       }
       //$remateDetalleTest = $remateArray; //Mario si lo quiero ver con numeros para id errores
       

       $precios = array();
        //test how many lines each Remate have
        //if(count($remateArray) !== 0){ echo count($remateArray).'<br>'; }
        for ($ii = 0; $ii < count($remateArray); $ii++) {
            if (count($remateArray) !== 0) {


        //Precio siempre es el primero
            if (stripos($remateArray[0], 'dólares') !== false || stripos($remateArray[0], 'colones') !== false) {
            $precio = $remateArray[0];
            }else{

                
                //Precio siempre es el primerocon la base // necesito poner que la primera que salga con base
                if (stripos($remateArray[$ii], 'con una base') !== false || stripos($remateArray[$ii], 'con la base') !== false ) {
                    
                    $precio = $remateArray[$ii + 1]; //le sumo 2
                    $precio = str_replace("de", "", $precio);
                    $precio = str_replace("con una base", "", $precio);
                    $precio = str_replace("y", "", $precio);

                    array_push($precios, $precio); //meto todos los precios que encontre en un array pero solo el N1 es el precio real
                    $precio =  $precios[0];
                    $precioShort = trimtext(str_replace("y", "", $precio), 7);
                    
                    //$precioShort    =  wordsToNumber( $precioShort );
                }
        
            }

  
                if (strpos($precio, 'dólares') !== false) {
                    $moneda = 'dolares';
                } else {
                    $moneda = 'colones';
                }

                //noe encuentra ni mide tampoco la encuentra
                if (stripos($remateArray[$ii], 'se señalan las') !== false) {
                    $fechadelRemate             = $remateArray[$ii + 1]; //le sumo 2
                    
                    $fechadelRemate = str_replace("Setiembre", "Septiembre", $fechadelRemate);
                    $fechadelRemate = str_replace("setiembre", "septiembre", $fechadelRemate);
                  
                    $fechadelRemateNumeral      = preg_split('/ del /i',  $fechadelRemate, 0, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

                    $horaRemate = $fechadelRemateNumeral[0];
                    $fechadelRemateNumeral      = preg_split('/ de /i',  $fechadelRemateNumeral[1], 0, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
                    
                    $dia = wordsToNumber(' '.$fechadelRemateNumeral[0]); //mando a comvertir a numero
                    $mes = ucfirst($fechadelRemateNumeral[1]);          //mando a comvertir a numero
                    echo 'dia '. $dia;
                    //no convierte bien entonces yo cambio
                    //$ano =  wordsToNumber(' '.$fechadelRemateNumeral[2]);
                    $ano = $fechadelRemateNumeral[2];
                    $ano =  str_replace(",", "", $ano); 
                    $ano =  str_replace("dos mil diecinueve",   "2019", $ano); 
                    $ano =  str_replace("dos mil veinte",       "2020", $ano); 
                    $ano =  str_replace("dos mil veintiuno",    "2021", $ano); 
                    $ano =  str_replace("dos mil veintidos",    "2022", $ano); 
                    $ano =  str_replace("dos mil veintitres",   "2023", $ano); 
                    $ano =  str_replace("dos mil veinticuatro", "2024", $ano); 

                     
                    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                    $nombreMes = str_replace($meses_ES, $meses_EN, $mes);

                    $date = $dia.' '.$nombreMes.' '.$ano;
                    $fechadelRemateNumeral =  date('Y-m-d', strtotime($date));
                    //* DateFormat Y-m-d  d-m-Y

                 // echo 'CPT Field fecha remate: '. $date. '<br> Hora: '.$horaRemate;
                  

                }

                
 

                if ($remateArray[$ii] === 'mide:') {
                    $mide = $remateArray[$ii + 1];
                    
                    $mide = str_replace("para tal efecto", "", $mide);  
                    $mide = preg_split('/ plano: /i',  $mide, 0, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
                    $mide = $mide[0];
                   // echo $mide;
                }




                if (stripos($tipo_De_Remate, 'finca') !== false) {
                    $tipo_De_Remate = 'propiedad';
                }else{
                    
                    if (stripos($tipo_De_Remate, 'vehículo') !== false) {
                        $tipo_De_Remate = 'vehiculo';
                    }
                    if (stripos($tipo_De_Remate, 'automóvil') !== false) {
                        $tipo_De_Remate = 'vehiculo';
                    }
                    if (stripos($tipo_De_Remate, 'motocicleta') !== false) {
                        $tipo_De_Remate = 'motocicleta';
                    }
                    if (stripos($tipo_De_Remate, 'embarcación') !== false) {
                        $tipo_De_Remate = 'embarcacion';
                    }
                   
                }


             

                 ///tipo de bien y categoria
                 if (stripos($remateArray[$ii], 'categoría') !== false) {
                    $categoria = $remateArray[$ii + 1];
                    $categoria = str_replace(":", "", $categoria);
                    $categoria= strtolower ( $categoria);
                    $tipo_De_Remate = $categoria;
                }else{

                    if (stripos($remateArray[$ii], 'sáquese a remate') !== false) {
                        $tipo_De_Remate = $remateArray[$ii + 1];
                    }  
    
                }


                if($tipo_De_Remate !== 'propiedad'){
                    ///VEHICULOS
                if (stripos($remateArray[$ii], 'carrocería') !== false && $tipo_De_Remate == 'vehiculo') {
                    $carrocería = $remateArray[$ii + 1];
                    $carrocería = str_replace(":", "", $carrocería);
                }
                if (stripos($remateArray[$ii], 'capacidad') !== false && ($tipo_De_Remate == 'motocicleta' || $tipo_De_Remate == 'vehiculo')) {
                    $capacidad = $remateArray[$ii + 1];
                    $capacidad = str_replace(":", "", $capacidad);
                }
                if (stripos($remateArray[$ii], 'marca') !== false) {
                    $marca = $remateArray[$ii + 1];
                    $marca = str_replace(":", "", $marca);
                }

            }



                //FINCAS
                
                if (stripos($remateArray[$ii], 'provincia') !== false) {
                    $provincia = $remateArray[$ii + 1];
                    if (stripos($provincia, 'san josé.') !== false) {$provincia = 'san josé';}
                    if (stripos($provincia, 'heredia.') !== false) {$provincia = 'heredia';}
                    if (stripos($provincia, 'alajuela.') !== false) {$provincia = 'alajuela';}
                    if (stripos($provincia, 'guanacaste.') !== false) {$provincia = 'guanacaste';}
                    if (stripos($provincia, 'cartago.') !== false) {$provincia = 'cartago';}
                    if (stripos($provincia, 'puntarenas.') !== false) {$provincia = 'puntarenas';}
                    if (stripos($provincia, 'limón.') !== false) {$provincia = 'limón';}
                    $provincia = preg_replace('/\d/', '', $provincia);
                    $provincia = str_replace("()", "", $provincia);
                    $provincia = str_replace("().", "", $provincia);
                    $provincia = str_replace("de", "", $provincia);
                    
                }
                if (stripos($remateArray[$ii], 'distrito') !== false) {
                    $distrito = $remateArray[$ii + 1];
                    $distrito = preg_replace('/\d/', '', $distrito);
                    $distrito = str_replace(":", "", $distrito);
                    $distrito = str_replace("-", "", $distrito);
                    $distrito = str_replace("()", "", $distrito);
                }
                if (stripos($remateArray[$ii], ' distrito ') !== false) {
                    $distrito = $remateArray[$ii + 1];
                    $distrito = preg_replace('/\d/', '', $distrito);
                    $distrito = str_replace("-", "", $distrito);
                    $distrito = str_replace(":", "", $distrito);
                    $distrito = str_replace("()", "", $distrito);
                    
                }

                if (stripos($remateArray[$ii], 'cantón') !== false) {
                    $canton = $remateArray[$ii + 1];
                    $canton = preg_replace('/\d/', '', $canton);
                    $canton = str_replace(" de la", "", $canton);
                    $canton = str_replace("cantón ", "", $canton);
                    $canton = str_replace(":", "", $canton);
                    $canton = str_replace("-", "", $canton);
                    $canton = str_replace("()", "", $canton);
                    
                }

                if (stripos($remateArray[$ii], 'hipotecaria') !== false) {
                    $rematante = $remateArray[$ii];
                    $rematante = str_replace("ejecución hipotecaria de ", "", $rematante);
                }

                if (stripos($remateArray[$ii], 'juzgado') !== false) {
                    $juzgado = $remateArray[$ii];
                }

                if (stripos($remateArray[$ii], 'expediente') !== false ) {
                    $expediente = $remateArray[$ii + 1];
                    $expediente = str_replace(":", "", $expediente);
                    $expediente = str_replace("n°", "", $expediente);
                }

                if (stripos($remateArray[$ii], 'contra') !== false) {

                    $rematado = $remateArray[$ii + 1];

                    if (stripos($rematado, ' exp: ') !== false) {
                        
                        $split = explode('exp:', $rematado);
                        $rematado   = $split[0];
                        $expediente = $split[1];
                    }
                  

                }
         
             

                if (stripos($remateArray[$ii], 'matrícula') !== false) {

                    $matricula = $remateArray[$ii];
                    
                    $matricula = str_replace("número ", "", $matricula);
                    $matricula = str_replace("matrícula", "", $matricula);
                    
                    $matricula = str_replace("n°", "", $matricula);
                    
                }

                if (stripos($remateArray[$ii], 'gravámenes') !== false) {
                    $gravamenes = $remateArray[$ii];
                }

                if (stripos($remateArray[$ii], 'derecho') !== false) {
                    $derecho = $remateArray[$ii];
                    $derecho = str_replace("derecho ", "", $derecho);
                }
                 
                if (stripos($remateArray[$ii], 'la cual es') !== false) {
                    $laCuales = $remateArray[$ii + 1];
                    $laCuales = str_replace("situada en el ", "", $laCuales);
                }
                 
             
                
                



            }
        }


        if ( ! is_admin() ) {


            $publi=null;
            if($GLOBALS['publicacion'] === 'Primera publicación'){
                $publi =1;
            }else{
                $publi =2;
            }
            
            
            
        //if($GLOBALS['remateNumber'] < 2){ // pongo si quiero limite
            $remateNumber   = $i;
            //id del post
            $remateIdNumber = $GLOBALS['boletinNumber'].'_'. $publi.'_'.$remateNumber.date("y");
            $remateIdNumber = str_replace(" ", "", $remateIdNumber);
           



            $value = []; 
            $value = (array) null;
            if ($GLOBALS['tipo_De_Remate']=== 'propiedad'){

            $value = array(
                'numero_boletin'        => $GLOBALS['boletinNumber'],
                'remateidnumber'        => $GLOBALS['remateIdNumber'],
                'numero_remate'         => $GLOBALS['remateIdNumber'],
                'fechadelRemate'        => $GLOBALS['fechadelRemate'],
                'fechadelrematenumeral' => $GLOBALS['fechadelRemateNumeral'],
                'horaremate'            => $GLOBALS['horaRemate'],
                'gravamenes'            => $GLOBALS['gravamenes'],
                'tipo_de_remate'        => $GLOBALS['tipo_De_Remate'],
                'la_cual_es'            => $GLOBALS['laCuales'],
                'precio_largo'          => $GLOBALS['precio'],
                'precio_numeral'        => wordsToNumber(' '.$GLOBALS['precioShort']),
                'matricula'             => $GLOBALS['matricula'],
                'derecho'               => $GLOBALS['derecho'],
                'canton'                => $GLOBALS['canton'],
                'distrito'              => $GLOBALS['distrito'],
                'provincia'             => $GLOBALS['provincia'],
                'moneda'                => $GLOBALS['moneda'],
                'mide'                  =>  wordsToNumber($GLOBALS['mide']),
                'plano'                 => $GLOBALS['plano'],
                'rematante'             => $GLOBALS['rematante'],
                'rematado'              => $GLOBALS['rematado'],
                'juzgado'               => $GLOBALS['juzgado'],
                'expediente'            => $GLOBALS['expediente'],
                'remateDetalle'         => $GLOBALS['remateDetalle'],
                'publicacion'           => $GLOBALS['publicacion'],
            );

        }else{
            $value = array(
                'numero_boletin'        => $GLOBALS['boletinNumber'],
                'remateidnumber'        => $GLOBALS['remateIdNumber'],
                'numero_remate'         => $GLOBALS['remateIdNumber'],
                'fechadelRemate'        => $GLOBALS['fechadelRemate'],
                'fechadelrematenumeral' => $GLOBALS['fechadelRemateNumeral'],
                'horaremate'            => $GLOBALS['horaRemate'],
                'gravamenes'            => $GLOBALS['gravamenes'],
                'tipo_de_remate'          => $GLOBALS['tipo_De_Remate'],
                'la_cual_es'            => $GLOBALS['laCuales'],
                'precio_largo'          => $GLOBALS['precio'],
                'precio_numeral'        => wordsToNumber(' '.$GLOBALS['precioShort']),
                'matricula'             => $GLOBALS['matricula'],
                'derecho'               => $GLOBALS['derecho'],
                'moneda'                => $GLOBALS['moneda'],
                'marca'                 => $GLOBALS['marca'],
                'categoria'             => $GLOBALS['categoria'],
                'carrocería'            => $GLOBALS['carrocería'],
                'capacidad'             => $GLOBALS['capacidad'],
                'rematante'             => $GLOBALS['rematante'],
                'rematado'              => $GLOBALS['rematado'],
                'juzgado'               => $GLOBALS['juzgado'],
                'expediente'            => $GLOBALS['expediente'],
                'remateDetalle'         => $GLOBALS['remateDetalle'],
                'publicacion'           => $GLOBALS['publicacion'],
            );
        }





            $tags = array(
                $GLOBALS['tipo_De_Remate'],
                $GLOBALS['derecho'],
                $GLOBALS['provincia'],
                $GLOBALS['moneda'],
            );

       
     
            //Creo post
           if($postRemates){
            insertPost($value, $tags);
           }else{
            //crea boxes para visualisar
            createRemateBox();
           }
           
        //}

         
        }
         
    


        //$boletinMeter = $boletinMeter.'<br>'.$GLOBALS['boletinNumber'];
        //update_field('remates', $GLOBALS['boletinNumber'] , $GLOBALS['rematesPg']);


    } //loop N1 ends If End too

    //Creo la lista de boletines que ya e metido
    $boletines      = get_field("remates", $GLOBALS['rematesPg']);
    $arrayBoletines = explode("\n", $boletines);
   // print_r($arrayBoletines);
 
    if (in_array($GLOBALS['boletinNumber'], $arrayBoletines)) 
    { 
        wp_die( '<pre>' . $GLOBALS['boletinNumber']."found" . '</pre>' );
    } 
    else
    { 
        
        $boletines2 = $boletines.' '.$GLOBALS['boletinNumber'];
        echo "not found".$boletines2; 
        update_field('remates', $boletines2, $GLOBALS['rematesPg']);
    } 



    if ( !is_admin() ) {
        echo '<br>_______________________________________________________<br>';
        echo '<br>TOTAL DE REMATES:' .          $GLOBALS['rematesTotal'].  '<br>';
        echo '<br><b>El boletin es: </b>' . $GLOBALS['boletinNumber'];
        echo '<div class="container">'.    $GLOBALS['publicacion'];
    }
    
    
  

}





function createRemateBox()
{
 
  
    ?>
<div class="card mb-4 col-md-6 shadow-sm">

  <div class="card-header  casasItem">
  <?php
 
if ($GLOBALS['tipo_De_Remate'] === 'propiedad') {
        echo '<i class="fa fa-home fa-4x"></i>';
    }

    if ($GLOBALS['tipo_De_Remate'] === 'vehiculo') {
        echo '<i class="fa fa-car fa-4x" aria-hidden="true"></i>';
    }

    if ($GLOBALS['tipo_De_Remate'] === 'motocicleta') {
        echo '<i class="fa fa-motorcycle fa-4x" aria-hidden="true"></i>';
    }
   

    if ($GLOBALS['tipo_De_Remate'] === 'embarcacion') {
        echo '<i class="fa fa-ship fa-4x" aria-hidden="true"></i>';
    }

    echo '<br><spam class="tipoBien"' . $GLOBALS['tipo_De_Remate'] . '</spam>';
    ?>




<?php if (!empty($GLOBALS['precio'])) {?>
    <div class="precio">
    <div class="numeral">
      <?php
echo '<b>Precio redondeado:</b>';
        echo  currencySymbol($GLOBALS['moneda'])  . wordsToNumber(' '.$GLOBALS['precioShort']);
        ?>
    </div>

    <div class="escrito">
    <?php
echo '<b>Precio Real:</b><br>';
        echo $GLOBALS['precio'];
        ?>
    </div>

    </div><!--Precio-->
    <?php }?>


  </div><!--Header-->

  <div class="card-body ">
        <div class="divTable remate">
        
          <div class="divTableBody">

            <div class="divTableRow">
            
            <div class="divTableCell Descrip">id:</div>
              <div class="divTableCell Value"><?php echo $GLOBALS['remateIdNumber']; ?></div>

              <div class="divTableCell Descrip">Fecha Remate:</div>
              <div class="divTableCell Value">
              <?php echo $GLOBALS['fechadelRemate']; ?>
              <?php echo $GLOBALS['fechadelRemateNumeral']; ?>
              
              </div>
              <div class="divTableCell Descrip">gravamenes:</div>
              <div class="divTableCell Value"><?php echo $GLOBALS['gravamenes']; ?></div>
              <div class="divTableCell Descrip">Provincia:</div>
              <div class="divTableCell Value"><?php echo $GLOBALS['provincia']; ?></div>
              <div class="divTableCell Descrip">Distrito:</div>
              <div class="divTableCell Value"><?php echo $GLOBALS['distrito']; ?></div>
              <div class="divTableCell Descrip">Canton:</div>
              <div class="divTableCell Value"><?php echo $GLOBALS['canton']; ?></div>


             <?php if($GLOBALS['tipo_De_Remate'] == 'Propiedad'){ ?> 
              <div class="divTableCell Descrip">m2:</div>
              <div class="divTableCell Value"><?php echo '('.wordsToNumber($GLOBALS['mide']) .')' . $GLOBALS['mide'] ?></div>

            <?php }elseif ($GLOBALS['tipo_De_Remate'] == 'Vehículo' || $GLOBALS['tipo_De_Remate'] == 'Motocicleta') { ?>

              <div class="divTableCell Descrip">marca:</div>
              <div class="divTableCell Value"><?php echo $GLOBALS['marca']; ?></div>

              <div class="divTableCell Descrip">categoria:</div>
              <div class="divTableCell Value"><?php echo $GLOBALS['categoria']; ?></div>

              <?php if ($GLOBALS['tipo_De_Remate'] == 'Vehículo') { ?>
              <div class="divTableCell Descrip">carrocería:</div>
              <div class="divTableCell Value"><?php echo $GLOBALS['carrocería']; ?></div>
              <?php } ?>

              <div class="divTableCell Descrip">capacidad:</div>
              <div class="divTableCell Value"><?php echo $GLOBALS['capacidad']; ?></div>
                
            <?php } ?>
          
              <div class="divTableCell Descrip">matricula:</div>
              <div class="divTableCell Value"><?php echo $GLOBALS['matricula']; ?></div>

              <div class="divTableCell Descrip">Rematante:</div>
              <div class="divTableCell Value"><?php echo $GLOBALS['rematante']; ?></div>
              <div class="divTableCell Descrip">contra:</div>
              <div class="divTableCell Value"><?php echo $GLOBALS['rematado']; ?></div>

              <div class="divTableCell Descrip">Juzgado:</div>
              <div class="divTableCell Value"><?php echo $GLOBALS['juzgado']; ?></div>
              <div class="divTableCell Descrip">Expediente:</div>
              <div class="divTableCell Value"><?php echo $GLOBALS['expediente']; ?></div>
            </div>

          </div>
          </div>
        <button type="button" class="btn btn-lg btn-block btn-outline-primary">Leer mas</button>
        <?php print_r($GLOBALS['remateDetalleTest']);?>
      </div>
  </div><!--card-->

<?php
echo '</div>';
}




function currencySymbol($moneda){
    if ( $moneda !== 'colones') {
        $moneda1 = '$';
    } else {
        $moneda1 = '₡';
    }
    return $moneda1;
}




  
  function insertPost($value, $tags){

   
    $postTitle = $value['remateidnumber'];
    $post_title = sanitize_title( $postTitle );

      // unhook this function so it doesn't loop infinitely
      remove_action('save_post', 'insertPost');
  
 
      if( $value['remateidnumber'] != '' ){
      // Inserto un post y despues actualiso datos
      $post_id = array( 
        'post_parent'   => 1,
        'post_title'    =>  $value['remateidnumber'],
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_category' => 1,
        'tags_input'    => $tags,
         );

         

         ////ACTUALIZO LOS ACF 
        if( post_exists( $post_title ) ){
            echo '<br>si existe! pueden estar en trash '.$post_title;
            
            //var_dump($post_id);
        }else{
            echo 'no existe. postiando... '.$post_title.'<br>';
            $postID = wp_insert_post( $post_id );  //como no exite lo inserto
           
             
           update_field('postgroup', $value, $postID);
        

          
             //update_post_meta( $post_id , $key = 'postgroup_fechadelrematenumeral', $value = $value['postgroup_fechadelrematenumeral'] );

           
        }
     

      }else{
        echo ('there is not ids'); 
      }
  
      // re-hook this function
      add_action('save_post', 'insertPost');
  
  }
  ?>