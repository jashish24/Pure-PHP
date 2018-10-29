<?php include('../pdf/mpdf.php'); ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="icon" href="favicon.ico" type="image/x-icon" />
</head>
<body>
<?php
  for ($i = 0; $i < 42; $i++) {
?>
<table>
  <thead><tr><th colspan="9">Ticket #<?php print $i + 1; ?></th></tr></thead>
  <tbody>
    <?php
      $tam_array = array();
      for ($r = 1; $r <= 3; $r++) {
        $row_array = array();
        $row_num = 1;
        $num_choose = array_combine(range(1, 9), range(1, 9));
        for ($dc = 1; $dc <= 9; $dc++) {
          if (isset($tam_array[$dc])) {
            if ($tam_array[$dc]['done'] == 0) {
              $row_array[] = $dc;
            }
          }
        }
        $count = 1;
        while (count($row_array) < 5) {
          $block_num = array_rand($num_choose, 1);
          if (in_array($block_num, $row_array)) {
            continue;
          }
          $count++;
          $row_array[$count] = $block_num;
          unset($num_choose[$block_num]);
        }
        $corner_min = min($row_array);
        $corner_max = max($row_array);
        $row = '<tr>';
        for ($c = 1; $c <= 9; $c++) {
          if (!isset($tam_array[$c])) {
            if ($c == 9) {
              $min = (($c - 1) * 10);
              $min = ($min == 0) ? 1 : $min;
              $max = ($c * 10);
              $tam_array[$c] = array_combine(range($min, $max), range($min, $max));
              $tam_array[$c]['done'] = !isset($tam_array[$c]['done']) ? 0 : $tam_array[$c]['done'];
            }
            else {
              $min = (($c - 1) * 10);
              $min = ($min == 0) ? 1 : $min;
              $max = (($c * 10) - 1);
              $tam_array[$c] = array_combine(range($min, $max), range($min, $max));
              $tam_array[$c]['done'] = !isset($tam_array[$c]['done']) ? 0 : $tam_array[$c]['done'];
            }
          }
          if (in_array($c, $row_array)) {
            $corner = '';
            
            if (($c == $corner_min || $c == $corner_max) && $r != 2) {
              $corner = ' corner';
            }
            
            $rand_array = $tam_array[$c];
            unset($rand_array['done']);
            $current_num = array_rand($rand_array, 1);
            $tam_array[$c]['done']++;
            unset($tam_array[$c][$current_num]);
            $row .= '<td class="filled' . $corner . '">' . $current_num . '</td>';
          }
          else {
            $row .= '<td class="empty"></td>';
          }
        }
        $row .= '</tr>';
        print $row;
      }
    ?>
  </tbody>
</table>
<?php } ?>
</body>
</html>