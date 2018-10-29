<!DOCTYPE html>
<html lang="en-US">
<head>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src='https://code.responsivevoice.org/responsivevoice.js'></script>
  <script src='js/scripts.js'></script>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="icon" href="favicon.ico" type="image/x-icon" />
</head>
<body>
  <?php
    if (isset($_SESSION)) {
      unset($_SESSION);
    }
    print '<span class="can-be-hidden tam-rand-num">0</span>';
    $number_list = '<ul class="can-be-hidden tam-left-num">';
    for ($i = 1; $i <= 90; $i++) {
      $number_list .= '<li class="number-list number-list-' . $i . '"><a href="javascript:void(0);">' . $i . '</a></li>';
    }
    $number_list .= '</ul>';
    print $number_list;
    print '<span class="clock">10</span><a class="can-be-hidden" title="Generate Next" href="javascript:void(0);"id="generate-next">Generate Next</a><a class="gen-ticket" title="Generate Tickets" href="gen_ticket.php">Generate Tickets</a>';
    print '<div class="can-be-hidden hide-all">&nbsp;</div>';
  ?>
</body>
</html>