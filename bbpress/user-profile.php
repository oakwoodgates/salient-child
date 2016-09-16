<?php

/**
 * User Profile
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php do_action( 'bbp_template_before_user_profile' ); ?>

	<div id="bbp-user-profile" class="bbp-user-profile"><p></p>
		<?php bbp_get_displayed_user_field( 'description' ) ; ?>
		<h4 class="entry-title"><span style="color:#66c3c9;"><?php bbp_displayed_user_field( 'first_name' ); ?>'s profile</span></h4>
        <p class="profile-top-meta">
        <span class="bbp-user-forum-role"><?php  printf( __( '%s',      'bbpress' ), bbp_get_user_display_role()    ); ?></span>
			<span class="bbp-user-topic-count"><?php printf( __( 'Topics Started: %s',  'bbpress' ), bbp_get_user_topic_count_raw() ); ?></span>
			<span class="bbp-user-reply-count"><?php printf( __( 'Replies Created: %s', 'bbpress' ), bbp_get_user_reply_count_raw() ); ?></span></p>
        
		<div class="bbp-user-section">
                <p class="bbp-user-country">- Country : <span class="profile-answer"><?php bbp_displayed_user_field( 'biddy_country' ); ?></span></p>
				<p class="bbp-user-description">- Personal Bio : <span class="profile-answer"><?php bbp_displayed_user_field( 'description' ); ?></p>
                <p class="bbp-user-exp">- Experience Level : <span class="profile-answer"><?php bbp_displayed_user_field( 'xp_level' ); ?></span></p>
            <p class="bbp-user-why">- Why do you use Tarot? <span class="profile-answer"><?php bbp_displayed_user_field( 'why_tarot' ); ?></span></p>
            <p class="bbp-user-how">- How do you use the Tarot in your daily life? <span class="profile-answer"><?php bbp_displayed_user_field( 'how_use' ); ?></span></p>
            <p class="bbp-user-buddy">- Are you seeking a Tarot Buddy? <span class="profile-answer"><?php bbp_displayed_user_field( 'looking_buddy' ); ?></span></p>
            <p class="bbp-user-buddy-profile">- What are you looking for in a Tarot Buddy? <span class="profile-answer"><?php bbp_displayed_user_field( 'buddy_profile' ); ?></span></p>

	

		</div>
	</div><!-- #bbp-author-topics-started -->

	<?php do_action( 'bbp_template_after_user_profile' ); ?>