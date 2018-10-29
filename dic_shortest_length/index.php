<?php

  $start = 'hit';
  $end = 'cog';

  $dic = ['hot', 'dot', 'dog', 'lot', 'log'];
  $distance = -1;

  while ($start != $end) {
    foreach ($dic as $word) {
      $lev = levenshtein($start, $word);
      
      if ($lev == 1) {
        $start = $word;
        $distance++;
        
        $lev1 = levenshtein($start, $end);
      
        if ($lev1 == 1) {
          $distance++;
          $start = $end;
        }
      }
    }
  }

  print $distance;