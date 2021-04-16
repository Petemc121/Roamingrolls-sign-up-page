<html>

<?php

get_header();

?>


<body>


<?php



  if( have_posts() ) {

      while( have_posts() ) {

          the_post();
          get_template_part( 'Template-parts/content', 'profiles');



      }



  }


?>


</body>

<div>

<?php

get_footer();

?>

</div>




</html>
