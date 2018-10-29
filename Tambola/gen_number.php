<?php
if (session_id() == '') {
  session_start();
}
if (isset($_POST) && !empty($_POST)) {
  $numbers_array = [];
  $first_load = isset($_POST['first_load']) ? strip_tags($_POST['first_load']) : 0;
  if ($first_load == 1) {
    unset($_SESSION['tam_array']);
    for ($i = 1; $i <= 90; $i++) {
      $numbers_array[$i] = $i;
    }
  }
  else if (isset($_SESSION['tam_array'])) {
    $numbers_array = $_SESSION['tam_array'];
  }
  
  if (empty($numbers_array)) {
    print_r(json_encode('error'));
    exit;
  }

  $num = array_rand($numbers_array, 1);
  unset($numbers_array[$num]);    
  $_SESSION['tam_array'] = $numbers_array;
  
  $return_data['data'] = $_SESSION['tam_array'];
  $return_data['num'] = $num;
  
  $num_to_word_array = [
    0 => 'zero',
    1 => 'one',
    2 => 'two',
    3 => 'three',
    4 => 'four',
    5 => 'five',
    6 => 'six',
    7 => 'seven',
    8 => 'eight',
    9 => 'nine',
    10 => 'ten',
    11 => 'eleven',
    12 => 'twelve',
    13 => 'thirteen',
    14 => 'fourteen',
    15 => 'fifteen',
    16 => 'sixteen',
    17 => 'seventeen',
    18 => 'eighteen',
    19 => 'nineteen',
    20 => 'twenty',
    30 => 'thirty',
    40 => 'forty',
    50 => 'fifty',
    60 => 'sixty',
    70 => 'seventy',
    80 => 'eighty',
    90 => 'ninety',
  ];
  
  if ($num <= 20) {
    if ($num == 7) {
      $return_data['audio_string'] = 'Lucky number ' . $num_to_word_array[$num];
    }
    else {
      $return_data['audio_string'] = 'Only number ' . $num_to_word_array[$num];
    }
  }
  else {
    $tens = floor($num / 10);
    $ones = $num - ($tens * 10);
    if ($ones == 0) {
      $return_data['audio_string'] = $tens . ' ' . $num_to_word_array[$ones] . ' ' . $num_to_word_array[($tens * 10)];
    }
    else {
      $return_data['audio_string'] = $tens . ' ' . $ones . ' ' . $num_to_word_array[($tens * 10)] . ' ' . $num_to_word_array[$ones];
    }
  }
  
  print_r(json_encode($return_data));
  exit;
}
else {
  $_SESSION['tam_array'] = array_combine(range(1, 90), range(1, 90));
}