<?php




function wordsToNumber($data)
{
    ///echo ($data);
    //remove tildes
    $data = eliminar_tildes($data);  
    $data = strtolower($data);
    
   
    //si tiene metros
    if (stripos($data, 'metros') !== false) {
      //$data = $data[0];
      $data = preg_split('/ metros /i', $data, 0, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
      $data = $data[0];
  }
   


      // Replace all number words with an equivalent numeric value
      $data = strtr(
          $data,
          array(
            'cero'      => '0',
            'uno'      => '1',
            'dos'      => '2',
            'tres'     => '3',
            'cuatro'   => '4',
            'cinco'    => '5',
            'seis'     => '6',
            'siete'    => '7',
            'ocho'     => '8',
            'nueve'    => '9',
            'diez'     => '10',
            'once'     => '11',
            'doce'     => '12',
            'trece'    => '13',
            'catorce'  => '14',
            'quince'   => '15',
            'dieciseis' => '16',
            'diecisiete' => '17',
            'dieciocho' => '18',
            'diecinueve' => '19',
            'veinte' => '20',
            'veintiuno' => '21',
            'veintiun' => '21',
            'veintidos' => '22',
            'veintitres' => '23',
            'veinticuatro' => '24',
            'veinticinco' => '25',
            'veintiseis' => '26',
            'veintisiete' => '27',
            'veintiocho' => '28',
            'veintinueve' => '29',
            'treinta' => '30',
            'cuarenta' => '40',
            'cincuenta' => '50',
            'sesenta' => '60',
            'setenta' => '70',
            'ochenta' => '80',
            'noventa' => '90',
            'cien' => '100',
            'doscientos' => '200',
            'trecientos' => '300',
            'cuatrocientos' => '400',
            'quinientos' => '500',
            'seiscientos' => '600',
            'setecientos' => '700',
            'ochocientos' => '800',
            'novecientos' => '900',
            'mil' => '1000',
            'million' => '1000000',
            'millones' => '1000000',
            'billion' => '1000000000',
            ' y ' => ' ',
            'y' => ' ',
            'con' => ' ',
            'centimos' => ' ',
            'céntimos' => ' ',
            'cuatro' => ' ',
            'cuatros' => ' ',
            'decímetros' => ' ',
          )
      );
  

     
      
      // Coerce all tokens to numbers
      $parts = array_map(
          function ($val) {
              return floatval($val);
          },
          preg_split('/[\s-]+/', $data)
      );
      
     
   //me metia un array nulo al principio aca lo saco //no uso unset porque no toca el key solo el value
    if ($parts[0] == '') {array_splice($parts, 0, 1);}
  
   
   
   

      $stack = new SplStack; // Current work stack
      $sum   = 0; // Running total
      $last  = null;
  

      foreach ($parts as $part) {

          if (!$stack->isEmpty()) {
              // We're part way through a phrase
              if ($stack->top() > $part) {
                  // Decreasing step, e.g. from hundreds to ones
                  if ($last >= 1000) {
                      // If we drop from more than 1000 then we've finished the phrase
                      $sum += $stack->pop();
                      // This is the first element of a new phrase
                      $stack->push($part);
                  } else {
                      // Drop down from less than 1000, just addition
                      // e.g. "seventy one" -> "70 1" -> "70 + 1"
                      
                      $stack->push($stack->pop() + $part);
                  }
              } else {
                  // Increasing step, e.g ones to hundreds
                  $stack->push($stack->pop() * $part);
              }
          } else {
            
              // This is the first element of a new phrase
              $stack->push($part);
          }
  
          // Store the last processed part
          $last = $part;
      }
     
      
     return (number_format($sum + $stack->pop()));
       //return $sum + $stack->pop();
  }


function eliminar_tildes($cadena)
{

    $search = explode(",", "ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u");
    $replace = explode(",", "c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");
    $urlTitle = str_replace($search, $replace, $cadena);

    return $urlTitle;
}

function trimtext($data, $limit)
{
    $arr = explode(" ", $data);
    $new_arr = array_slice($arr, 0, $limit);
    return implode(" ", $new_arr);
}



?>