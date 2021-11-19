<?php 
/**
 * Template Name: Blank Page template
 */
get_header()
?>
<?php
    while ( have_posts() ) : the_post();
    the_content();

endwhile; // End of the loop.
?>

