<script>
$(document).ready(function() {
        // Transition effect for navbar 
        $(window).scroll(function() {
          // checks if window is scrolled more than 500px, adds/removes solid class
          if($(this).scrollTop() > 50) { 
              $('.navbar').removeClass('transparent');
          } else {
              $('.navbar').addClass('transparent');
          }
        });
});

$(document).ready(function(){
  $("button").click(function(){
    $('.navbar').removeClass('navcolor');
  });
});


</script>
</div>
</body>
</html>

