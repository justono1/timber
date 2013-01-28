<?php
	/**
	 * Timber functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
	 * Methods for PostMaster and WPHelper can be found in the /functions sub-directory
	 *
	 * @package 	WordPress
	 * @subpackage 	Timber
	 * @since 		Timber 0.1
	 */

	/* ========================================================================================================================
	
	Required external files
	
	======================================================================================================================== */
	$timber = str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__);
	define("TIMBER", $timber);
	define("TIMBER_URL", 'http://'.$_SERVER["HTTP_HOST"].TIMBER);
	define("TIMBER_LOC", $_SERVER["DOCUMENT_ROOT"].TIMBER);

	require_once('functions/starkers-utilities.php' );
	require_once('functions/functions-twig.php');
	require_once('functions/functions-post-master.php');
	require_once('functions/functions-php-helper.php');
	require_once('functions/functions-wp-helper.php');
	
	//require_once('functions/functions-theme-preview.php');

	/* ========================================================================================================================
	
	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme
	
	======================================================================================================================== */

	add_theme_support('post-thumbnails');
	add_theme_support('menus');
	
	register_nav_menus(array('primary' => 'Primary Navigation'));

	add_filter( 'sidebars_widgets', 'disable_all_widgets' );

	function disable_all_widgets( $sidebars_widgets ) {

		$sidebars_widgets = array( false );

		return $sidebars_widgets;
	}

	/* ========================================================================================================================
	
	Actions and Filters
	
	======================================================================================================================== */


	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );

	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */





	/* ========================================================================================================================
	
	Comments
	
	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments 
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>	
		<li>
			<article id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</article>
		<?php endif;
	}