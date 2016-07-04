<?php
/**
 * Template Name: Home
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header();

 
 $sites = array( 
    'Animal Rahat' => 'http://www.animalrahat.com/',
    'Animals in Film and TV' => 'http://www.animalsinfilmandtv.com/',
    'Canada\'s Shame' => 'http://www.canadasshame.com',
    'Name that Driver' => 'http://beta.namethatdriver.com',
    'PETA' => 'http://www.peta.org/',
    'PETA35' => 'http://35.peta.org/',
    'PETA 911' => 'http://www.peta911.org',
    'PETA Action' => 'http://action.peta.org/',
    'PETA France' => 'http://www.petafrance.com/',
    'PETA Germany' => 'http://www.peta.de/',
    'PETA India' => 'http://www.petaindia.com/',
    'PETA Latino' => 'http://www.petalatino.com/',
    'PETA Presents' => 'https://www.petapresents.org/',
    'PETA Presents Australia' => 'http://presents.peta.org.au/',
    'PETA Presents France' => 'http://presents.petafrance.com/',
    'PETA Presents Latino' => 'http://regalos.petalatino.com/',
    'PETA Presents Netherlands' => 'http://presents.peta.nl/',
    'PETA Presents UK' => 'https://www.petapresents.org.uk/',
    'PETA Prime' => 'http://prime.peta.org/',
    'Ringling Beats Animals' => 'http://www.ringlingbeatsanimals.com/',
    'SeaWorld of Hurt' => 'http://www.seaworldofhurt.com/',
    );

 ?>
 <style type="text/css">
ul {
    list-style: none;
}
.item-avatar {
    width: 15%;
    float: left;
}
.item-title {
    width: 85%;
    float: left;
}
ul#groups-list li  {
    padding: 2rem;
}
 </style>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	
	<h1>Frontpage.php</h1>
	

		<?php
		
		
if ( ! is_user_logged_in() ) { 

		wp_login_form(); 

	}?>
		<?php
		// Start the loop.
	/*	while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
	*/	?>
<?php if ( bp_has_groups() ) : ?>
 
    <div class="pagination">
 
        <div class="pag-count" id="group-dir-count">
            <?php bp_groups_pagination_count() ?>
        </div>
 
        <div class="pagination-links" id="group-dir-pag">
            <?php bp_groups_pagination_links() ?>
        </div>
 
    </div>
 
    <ul id="groups-list" class="item-list">
    <?php while ( bp_groups() ) : bp_the_group(); ?>
 
        <li>
            <div class="item-avatar">
                <a href="<?php bp_group_permalink() ?>"><?php bp_group_avatar( 'type=thumb&width=50&height=50' ) ?></a>
            </div>
 
            <div class="item">
                <div class="item-title"><h3><a href="<?php bp_group_permalink() ?>"><?php bp_group_name() ?></a></h3></div>
                <div class="item-meta"><span class="activity"><?php printf( __( 'active %s ago', 'buddypress' ), bp_get_group_last_active() ) ?></span></div>
 
                <div class="item-desc"><?php bp_group_description_excerpt() ?></div>
 
                <?php do_action( 'bp_directory_groups_item' ) ?>
            </div>
 
            <div class="action">
                <?php bp_group_join_button() ?>
 
                <div class="meta">
                    <?php bp_group_type() ?> / <?php bp_group_member_count() ?>
                </div>
 
                <?php do_action( 'bp_directory_groups_actions' ) ?>
            </div>
 
            <div class="clear"></div>
        </li>
 
    <?php endwhile; ?>
    </ul>
 
    <?php do_action( 'bp_after_groups_loop' ) ?>
 
<?php else: ?>
 
    <div id="message" class="info">
        <p><?php _e( 'There were no groups found.', 'buddypress' ) ?></p>
    </div>
 
<?php endif; ?>

<!-- From MAMP index.php -->
            <div class="row content">
                <div class="col-md-6 col-md-offset-3 wrap">		

<?php $sitesnum = count($sites); ?>
			
               <h2>Production Sites = <?php echo $sitesnum; ?></h2>
	
			       <table class="table table-responsive table-striped table-hover">
					   <?php
							
            foreach($sites as $name => $url) {
?>
                        <tr>
                            <td><a href="<?php echo $url;?>" target="_blank"><?php echo $name;?></td>
                            <td><i class="fa fa-check"></i></td>
                        </tr>
<?php  }  ?>
					</table>
                </div>
            </div>

	</main><!-- .site-main -->

	<?php // get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php // get_sidebar(); ?>
<?php get_footer(); ?>
