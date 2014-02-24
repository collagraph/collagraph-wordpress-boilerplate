<aside class="social-share">
    <h3>Share this page:</h3>

    <ul class="socialcount" data-url="<?php the_permalink(); ?>" data-share-text="<?php if (has_excerpt()): ?><?php the_excerpt(); ?><?php else: ?><?php the_title(); ?> from the NPA<?php endif; ?>">
        <li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" title="Share on Facebook"><span class="social-icon icon-facebook"></span><span class="count">Like</span></a></li>

        <li class="twitter"><a href="https://twitter.com/intent/tweet?text=<?php the_permalink(); ?>" title="Share on Twitter"><span class="social-icon icon-twitter"></span><span class="count">Tweet</span></a></li>

        <li class="googleplus"><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" title="Share on Google Plus"><span class="social-icon icon-googleplus"></span><span class="count">+1</span></a></li>
    </ul>
</aside>