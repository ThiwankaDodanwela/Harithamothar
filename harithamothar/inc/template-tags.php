<?php
/**
 * Custom template tags for this theme
 *
 * @package WordPress
 * @subpackage Haritha_Mothar
 * @since 1.0.0
 */

if ( ! function_exists( 'harithamothar_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function harithamothar_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		printf(
			'<span class="posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
			harithamothar_get_icon_svg( 'watch', 16 ),
			esc_url( get_permalink() ),
			$time_string
		);
	}
endif;

if ( ! function_exists( 'harithamothar_posted_by' ) ) :
	/**
	 * Prints HTML with meta information about theme author.
	 */
	function harithamothar_posted_by() {
		printf(
			'<span class="byline">%1$s<span class="screen-reader-text">%2$s</span><span class="author vcard"><a class="url fn n" href="%3$s">%4$s</a></span></span>',
			/* translators: 1: SVG icon. 2: post author, only visible to screen readers. 3: author link. */
			harithamothar_get_icon_svg( 'person', 16 ),
			__( 'Posted by', 'harithamothar' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
	}
endif;

if ( ! function_exists( 'harithamothar_comment_count' ) ) :
	/**
	 * Prints HTML with the comment count for the current post.
	 */
	function harithamothar_comment_count() {
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			echo harithamothar_get_icon_svg( 'comment', 16 );

			/* translators: %s: Name of current post. Only visible to screen readers. */
			comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'harithamothar' ), get_the_title() ) );

			echo '</span>';
		}
	}
endif;

if ( ! function_exists( 'harithamothar_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function harithamothar_entry_footer() {

		// Hide author, post date, category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			// Posted by
			harithamothar_posted_by();

			// Posted on
			harithamothar_posted_on();

			/* translators: used between list items, there is a space after the comma. */
			$categories_list = get_the_category_list( __( ', ', 'harithamothar' ) );
			if ( $categories_list ) {
				/* translators: 1: SVG icon. 2: posted in label, only visible to screen readers. 3: list of categories. */
				printf(
					'<span class="cat-links">%1$s<span class="screen-reader-text">%2$s</span>%3$s</span>',
					harithamothar_get_icon_svg( 'archive', 16 ),
					__( 'Posted in', 'harithamothar' ),
					$categories_list
				); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma. */
			$tags_list = get_the_tag_list( '', __( ', ', 'harithamothar' ) );
			if ( $tags_list ) {
				/* translators: 1: SVG icon. 2: posted in label, only visible to screen readers. 3: list of tags. */
				printf(
					'<span class="tags-links">%1$s<span class="screen-reader-text">%2$s </span>%3$s</span>',
					harithamothar_get_icon_svg( 'tag', 16 ),
					__( 'Tags:', 'harithamothar' ),
					$tags_list
				); // WPCS: XSS OK.
			}
		}

		// Comment count.
		if ( ! is_singular() ) {
			harithamothar_comment_count();
		}

		// Edit post link.
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers. */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'harithamothar' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">' . harithamothar_get_icon_svg( 'edit', 16 ),
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'harithamothar_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function harithamothar_post_thumbnail() {
		if ( ! harithamothar_can_show_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<figure class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</figure><!-- .post-thumbnail -->

			<?php
		else :
			?>

		<figure class="post-thumbnail">
			<a class="post-thumbnail-inner" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail( 'post-thumbnail' );
				?>
			</a>
		</figure>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'harithamothar_comment_avatar' ) ) :
	/**
	 * Returns the HTML markup to generate a user avatar.
	 */
	function harithamothar_get_user_avatar_markup( $id_or_email = null ) {

		if ( ! isset( $id_or_email ) ) {
			$id_or_email = get_current_user_id();
		}

		return sprintf( '<div class="comment-user-avatar comment-author vcard">%s</div>', get_avatar( $id_or_email, harithamothar_get_avatar_size() ) );
	}
endif;

if ( ! function_exists( 'harithamothar_discussion_avatars_list' ) ) :
	/**
	 * Displays a list of avatars involved in a discussion for a given post.
	 */
	function harithamothar_discussion_avatars_list( $comment_authors ) {
		if ( empty( $comment_authors ) ) {
			return;
		}
		echo '<ol class="discussion-avatar-list">', "\n";
		foreach ( $comment_authors as $id_or_email ) {
			printf(
				"<li>%s</li>\n",
				harithamothar_get_user_avatar_markup( $id_or_email )
			);
		}
		echo '</ol><!-- .discussion-avatar-list -->', "\n";
	}
endif;

if ( ! function_exists( 'harithamothar_comment_form' ) ) :
	/**
	 * Documentation for function.
	 */
	function harithamothar_comment_form( $order ) {
		if ( true === $order || strtolower( $order ) === strtolower( get_option( 'comment_order', 'asc' ) ) ) {

			comment_form(
				array(
					'logged_in_as'       => null,
					'title_reply'        => null,
				)
			);
		}
	}
endif;

if ( ! function_exists( 'harithamothar_the_posts_navigation' ) ) :
	/**
	 * Documentation for function.
	 */
	function harithamothar_the_posts_navigation() {
		$prev_icon = harithamothar_get_icon_svg( 'chevron_left', 22 );
		$next_icon = harithamothar_get_icon_svg( 'chevron_right', 22 );
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => sprintf( '%s <span class="nav-prev-text">%s</span>', $prev_icon, __( 'Newer posts', 'harithamothar' ) ),
				'next_text' => sprintf( '<span class="nav-next-text">%s</span> %s', __( 'Older posts', 'harithamothar' ), $next_icon ),
			)
		);
	}
endif;
