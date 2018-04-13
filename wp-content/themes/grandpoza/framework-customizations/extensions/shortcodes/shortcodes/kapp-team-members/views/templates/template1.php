
<div class="team-area team-area-1 row">

    <?php foreach ( $team_members as $member ) { ?>

    <div class="col-md-4 col-sm-6">
        <div class="single-member">
            <div class="single-member-header">
                <img src="<?php echo isset( $member["picture"]["url"]) ?  esc_url( $member["picture"]["url"] ) : ""; ?>" alt="<?php  echo esc_attr($member["name"]); ?>" />
                <div class="single-member-overlay t-center">
                    <ul class="social-icons list-inline is-inline-block pos-tb-center">
                        <li class="social-icons__item">
                            <a target="_blank" href="<?php  echo esc_url( $member["profile"]["facebook_id"] ); ?>">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li class="social-icons__item">
                            <a target="_blank" href="<?php  echo esc_url( $member["profile"]["twitter_id"] ); ?>">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li class="social-icons__item">
                            <a target="_blank" href="<?php  echo esc_url( $member["profile"]["linkedin_id"] ); ?>">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                        <li class="social-icons__item">
                            <a target="_blank" href="<?php  echo esc_url( $member["profile"]["google_id"] ); ?>">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="single-member-content">
                <h5 class="mb-5">
                    <?php  echo esc_html($member["name"]); ?>
                </h5>
                <p class="color-theme mb-10">
                    <?php echo esc_html($member["title"]); ?>
                </p>
                <p class="color-mid">
                    <?php echo esc_html($member["description"]); ?>
                </p>
            </div>
        </div>
    </div>

    <?php } ?>
</div>
