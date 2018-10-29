<?php

  $rows = 4;
  $columns = 4;
  $matrix = [];
  $done_elements = [];
  $max_length = 0;
  
  for ($i = 0; $i < $rows; $i++) {
    for ($j = 0; $j < $rows; $j++) {
      $matrix[$i][$j] = rand(0, 1);
    }
  }
  
  function largest_connected($matrix, $rows, $columns, $done_elements) {
    $result = 0;
    for ($i = 0; $i < $rows; ++$i) {
      for ($j = 0; $j < $rows; ++$j) {
        if ($matrix[$i][$j] == 1 && !isset($done_elements[$i][$j])) {
          $count = 1;
          calculate_length($matrix, $i, $j, $done_elements, $count, $rows, $columns);
          $result = max($result, $count);
        }
      }
    }
    
    return $result;
  }
  
  function calculate_length($matrix, $i, $j, &$done_elements, &$count, $rows, $columns) {
    $adjrows = [-1, -1, -1, 0, 0, 1, 1, 1];
    $adjcols = [-1, 0, 1, -1, 1, -1, 0, 1];
    
    $done_elements[$i][$j] = 1;
    
    for ($adj = 0; $adj < 8; ++$adj) {
      if (correct_cel($matrix, $i + $adjrows[$adj], $j + $adjcols[$adj], $done_elements, $rows, $columns)) {
        if ($matrix[$i + $adjrows[$adj]][$j + $adjcols[$adj]] == 1) {
          $count++;
          calculate_length($matrix, $i + $adjrows[$adj], $j + $adjcols[$adj], $done_elements, $count, $rows, $columns);
        }
      }
    }
  }
  
  function correct_cel($matrix, $i, $j, $done_elements, $rows, $columns) {
    return ($i >= 0) && ($i < $rows) && ($j >= 0) && ($j < $columns) && (isset($matrix[$i][$j]) && !isset($done_elements[$i][$j]));
  }
  
  print largest_connected($matrix, $rows, $columns, $done_elements);
  