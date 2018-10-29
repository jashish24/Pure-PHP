$(document).ready(function() {
  var myVar;
  var first_load = '1';
  $('#generate-next').stop().on('click', function() {
    clearTimeout(myVar);
    $.ajax({
      type: 'POST',
      url: './gen_number.php',
      data: 'type=update_company_list&first_load=' + first_load,
      dataType: 'json',
      success: function(result) {
        if (result == 'error') {
          $('span.tam-rand-num').text('All Done').css('font-size', '20px');
        }
        else {
          $('span.tam-rand-num').text(result.num);
          var data_text = '';
          $('ul li.number-list-' + result.num).addClass('appeared');
          var number_gen = parseInt(result.num);
          var speak_text = result.audio_string;
          responsiveVoice.speak(speak_text);
          
          myVar = setTimeout(function() {
            responsiveVoice.speak(speak_text);
          }, 3000);
        }
        
        first_load = 0;
      },
      error: function() {
        $('span.tam-rand-num').text('Error generating number. Try again!!!');
      }
    });
  });
/*   var clock = '';
  var interval = setInterval(function() {
    clearInterval(clock);
    $('span.clock').text('10');
    clock = setInterval(function() {
      var time = parseInt($('span.clock').text());
      time--;
      $('span.clock').text(time);
    }, 1000);
    $('#generate-next').trigger('click');
  }, 10000); */
});