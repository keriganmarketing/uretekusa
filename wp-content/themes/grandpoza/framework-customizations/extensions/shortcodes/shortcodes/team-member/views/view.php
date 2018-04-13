<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

     $profile = json_decode( $atts["profile"]);
?>
    <div class="team-area-1">
    <div class="single-member">
        <div class="single-member-header pt-15">
            <img src="<?php echo esc_url( $atts["picture"]["url"]); ?>" alt="<?php echo esc_url( $atts["picture"]["url"]); ?>" />
            <div class="single-member-overlay t-center">
                <ul class="social-icons list-inline is-inline-block pos-tb-center">
                    <li class="social-icons__item">
                        <a target="_blank" href="<?php  echo esc_url($profile->facebook_id); ?>">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li class="social-icons__item">
                        <a target="_blank" href="<?php  echo esc_url($profile->twitter_id); ?>">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li class="social-icons__item">
                        <a target="_blank" href="<?php  echo esc_url($profile->linkedin_id); ?>">
                            <i class="fa fa-linkedin"></i>
                        </a>
                    </li>
                    <li class="social-icons__item">
                        <a target="_blank" href="<?php  echo esc_url($profile->google_id); ?>">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="single-member-content">
            <h5 class="mb-5">
                <?php  echo esc_html($atts["name"]); ?>
            </h5>
            <p class="color-theme mb-10">
                <?php echo esc_html($atts["title"]); ?>
            </p>
            <p class="color-mid">
                <?php echo esc_html($atts["description"]); ?>
            </p>
        </div>
    </div>
</div>
