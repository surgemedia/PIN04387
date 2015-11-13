<?php 
/*=========================================
=            Truncated Content           =
=========================================*/
// $terms = get_field('delivery_method');
function getTaxNames($terms) {
         for ($i=0; $i < sizeof($terms); $i++) {
          if($i == 0)
          echo $terms[$i]->name;
          else {
          echo ",".$terms[$i]->name;
          }

         } 
  
}