<?php
/**
 * The template used for displaying data page content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php twentysixteen_post_thumbnail(); ?>

	<div class="entry-content">
	
	<div style="color:green;font-size: .81rem;">
		<?php	
		
echo '$_SERVER[\'PHP_SELF\'] Returns the filename of the currently executing script => ' . $_SERVER['PHP_SELF'] . '<br>';
echo '$_SERVER[\'GATEWAY_INTERFACE\'] Returns the version of the Common Gateway Interface (CGI) the server is using => ' . $_SERVER['GATEWAY_INTERFACE'] . '<br>';
echo '$_SERVER[\'SERVER_ADDR\'] Returns the IP address of the host server => ' . $_SERVER['SERVER_ADDR'] . '<br>';
echo '$_SERVER[\'SERVER_NAME\'] Returns the name of the host server (such as www.w3schools.com) => ' . $_SERVER['SERVER_NAME'] . '<br>';
echo '$_SERVER[\'SERVER_SOFTWARE\'] Returns the server identification string (such as Apache/2.2.24) => ' . $_SERVER['SERVER_SOFTWARE'] . '<br>';
echo '$_SERVER[\'SERVER_PROTOCOL\'] Returns the name and revision of the information protocol (such as HTTP/1.1) => ' . $_SERVER['SERVER_PROTOCOL'] . '<br>';
echo '$_SERVER[\'REQUEST_METHOD\'] Returns the request method used to access the page (such as POST) => ' . $_SERVER['REQUEST_METHOD'] . '<br>';
echo '$_SERVER[\'REQUEST_TIME\'] Returns the timestamp of the start of the request (such as 1377687496) => ' . $_SERVER['REQUEST_TIME'] . '<br>';
echo '$_SERVER[\'QUERY_STRING\'] Returns the query string if the page is accessed via a query string => ' . $_SERVER['QUERY_STRING'] . '<br>';
echo '$_SERVER[\'HTTP_ACCEPT\'] Returns the Accept header from the current request => ' . $_SERVER['HTTP_ACCEPT'] . '<br>';
echo '$_SERVER[\'HTTP_ACCEPT_CHARSET\'] Returns the Accept_Charset header from the current request (such as utf-8,ISO-8859-1) => ' . $_SERVER['HTTP_ACCEPT_CHARSET'] . '<br>';
echo '$_SERVER[\'HTTP_HOST\'] Returns the Host header from the current request => ' . $_SERVER['HTTP_HOST'] . '<br>';
echo '$_SERVER[\'HTTP_REFERER\'] Returns the complete URL of the current page (not reliable because not all user-agents support it) => ' . $_SERVER['HTTP_REFERER'] . '<br>';
echo '$_SERVER[\'HTTPS\'] Is the script queried through a secure HTTP protocol => ' . $_SERVER['HTTPS'] . '<br>';
echo '$_SERVER[\'REMOTE_ADDR\'] Returns the IP address from where the user is viewing the current page => ' . $_SERVER['REMOTE_ADDR'] . '<br>';
echo '$_SERVER[\'REMOTE_HOST\'] Returns the Host name from where the user is viewing the current page => ' . $_SERVER['REMOTE_HOST'] . '<br>';
echo '$_SERVER[\'REMOTE_PORT\'] Returns the port being used on the user\'s machine to communicate with the web server => ' . $_SERVER['REMOTE_PORT'] . '<br>';
echo '$_SERVER[\'SCRIPT_FILENAME\'] Returns the absolute pathname of the currently executing script => ' . $_SERVER['SCRIPT_FILENAME'] . '<br>';
echo '$_SERVER[\'SERVER_ADMIN\'] Returns the value given to the SERVER_ADMIN directive in the web server configuration file (if your script runs on a virtual host, it will be the value defined for that virtual host) (such as someone@w3schools.com) => ' . $_SERVER['SERVER_ADMIN'] . '<br>';
echo '$_SERVER[\'SERVER_PORT\'] Returns the port on the server machine being used by the web server for communication (such as 80) => ' . $_SERVER['SERVER_PORT'] . '<br>';
echo '$_SERVER[\'SERVER_SIGNATURE\'] Returns the server version and virtual host name which are added to server-generated pages => ' . $_SERVER['SERVER_SIGNATURE'] . '<br>';
echo '$_SERVER[\'PATH_TRANSLATED\'] Returns the file system based path to the current script => ' . $_SERVER['PATH_TRANSLATED'] . '<br>';
echo '$_SERVER[\'SCRIPT_NAME\'] Returns the path of the current script => ' . $_SERVER['SCRIPT_NAME'] . '<br>';
echo '$_SERVER[\'SCRIPT_URI\'] Returns the URI of the current page => ' . $_SERVER['SCRIPT_URI'] . '<br>';
?>
</div>
<?php
		the_content();

		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
				get_the_title()
			),
			'<footer class="entry-footer"><span class="edit-link">',
			'</span></footer><!-- .entry-footer -->'
		);
	?>

</article><!-- #post-## -->
