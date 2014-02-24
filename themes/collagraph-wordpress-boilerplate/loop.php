<?php
if (have_posts()):
    while (have_posts()): the_post();
       get_template_part('content');
    endwhile; // have_posts()
else:
   echo '<p>Nothing to display.</p>';
endif; // have_posts()
?>