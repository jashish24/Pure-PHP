<?php

  $total_arrays = 2;
  $total_elements = [4, 6];
  
  $all_arrays = [];
  
  for ($c_array = 1; $c_array <= $total_arrays; $c_array++) {
    for ($i = 0; $i < $total_elements[$c_array - 1]; $i++) {
      $all_arrays[$c_array][$i] = rand(-10000, 10000);
    }
  }

  function contiguous_sum($array) {
    $total = $max_total = 0;
    $count = count($array);
    for($i = 0; $i < $count; $i++) {
      $total += $array[$i];

      if($total < 0) {
        $total = 0;
      }

      if ($max_total < $total) {
        $max_total = $total;
      }
    }
    
    return $max_total;
  }

  function noncontiguous_sum($array) {
    $max_total = 0;
    $count = count($array);
    
    for($i = 0; $i < $count; $i++) {
      if ($array[$i] > 0) {
        $max_total += $array[$i];
      }
    }
    
    return $max_total;
  }

  for ($c_array = 1; $c_array <= $total_arrays; $c_array++) {
    print contiguous_sum($all_arrays[$c_array]) . ' ' . noncontiguous_sum($all_arrays[$c_array]) . PHP_EOL;
  }