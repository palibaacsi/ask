<?php
/*
*
*/

get_header('codex'); 
?>
        
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
    <div class="col" id="post-<?php echo $post->post_name; ?>">
        <h3><?php the_title(); ?></h3>
        <?php the_content(); ?>
    </div>
    <div class="col">

        <?php if( have_rows( 'snippet' ) ) : ?>

            <?php while( have_rows( 'snippet' ) ) : the_row(); ?>

                 <div class="highlight"><pre class="line-numbers" data-line="<?php echo the_sub_field( 'highlight' ); ?>"><code class="<?php echo the_sub_field( 'language' ); ?>"><?php echo the_sub_field( 'code' ); ?></code></pre></div>
                
            <?php endwhile; ?>

        <?php endif; ?>

        <?php
        if ( get_field( 'html_php_code' ) ) :
        $html = esc_html( str_replace( '<br />', '', get_field( 'html_php_code' ) ) ); 
        ?>
        <div class="highlight"><pre class="line-numbers" data-line="<?php echo get_field( 'highlight_css' ); ?>"><code class="language-php"><?php echo get_field( 'html_php_code' ); ?></code></pre></div>
        <?php endif; ?>
        <?php if ( get_field( 'css_code' ) ) : ?>
        <div class="highlight"><pre class="line-numbers" data-line="<?php echo get_field( 'highlight_html_php' ); ?>"><code class="language-css"><?php echo get_field( 'css_code' ); ?></code></pre></div>
        <?php endif; ?>
    </div>
        
<?php endwhile; endif; ?>

<?php get_footer('codex'); ?>