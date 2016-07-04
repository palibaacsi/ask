<?php
/*
* Template Name: Codex
*/

get_header('codex'); 
?>

<div class="heading" id="toc">
    <h2><?php _e( 'Table of Contents', 'peta-codex' ); ?></h2>
</div>
<div class="section toc">

<?php
$args = array(
    'category'          => 8,
    'orderby'           => 'title',
    'order'             => 'ASC',
    'posts_per_page'    => '999'
);
$table_of_contents = new WP_Query( $args );
$count = 0;
$num_per_column = round( $table_of_contents->post_count / 3 ); // divide total by columns
if ( $table_of_contents->have_posts() ) : ?>
     <div class="col">
        <ul>
        <?php while ( $table_of_contents->have_posts() ) : $table_of_contents->the_post(); ?>
            <?php if ( $count % $num_per_column == 0 && $count != 0 ) : ?>
                </ul>
            </div>
            <div class="col">
                <ul>
            <?php endif; ?> 
            <li><a href="#post-<?php echo $post->post_name; ?>"><?php the_title() ?></a></li>
            <?php $count++; ?>
        <?php endwhile; ?>
        </ul>
    </div>
<?php endif; 
wp_reset_postdata();
?>

</div>

<div class="heading">
    <h2><?php _e( 'Examples', 'peta-codex' ); ?></h2>
</div>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="section">
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
    </div>

<?php endwhile; ?>

    <div class="navigation">
        <div class="alignleft"><?php next_posts_link( '&laquo; Older Entries' ) ?></div>
        <div class="alignright"><?php previous_posts_link( 'Newer Entries &raquo;' ) ?></div>
    </div>

<?php else : ?>

    <h2><?php _e( 'Not Found', 'peta-codex' ); ?></h2>
    <p><?php _e( 'Sorry, but you are looking for something that isn\'t here.', 'peta-codex' ); ?></p>
    <?php get_search_form(); ?>

<?php endif; ?>

<?php get_footer('codex'); ?>