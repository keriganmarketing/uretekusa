
<div class="team-area team-area-2 row"> 

    <?php foreach ( $team_members as $member ) { ?>

    <div class="col-md-4 col-sm-6">

        <div class="single-member">

            <div class="single-member-header">
                <img src="<?php echo isset($member["picture"]["url"]) ?  esc_url( $member["picture"]["url"]) : ""; ?>" alt="<?php echo esc_attr( $member["name"] ); ?>" />
                <div class="single-member-overlay t-center">
                    <ul class="social-icons list-inline is-inline-block pos-tb-center">
                        <li class="social-icons__item">
                            <a target="_blank" href="<?php echo esc_url( $member["profile"]["facebook_id"] ); ?>">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li class="social-icons__item">
                            <a target="_blank" href="<?php echo esc_url( $member["profile"]["twitter_id"] ); ?>">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li class="social-icons__item">
                            <a target="_blank" href="<?php echo esc_url( $member["profile"]["linkedin_id"] ); ?>">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                        <li class="social-icons__item">
                            <a target="_blank" href="<?php echo esc_url( $member["profile"]["google_id"] ); ?>">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="single-member-name">
                <h4><?php echo  esc_attr($member["name"]); ?></h4>
            </div>

            <div class="single-member-info ptb-5 prl-20">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <span><?php esc_html_e( 'Speciality' , 'grandpoza' ); ?></span>
                            </td>
                            <td><?php echo esc_attr($member["title"]); ?></td>
                        </tr>
                        <tr>
                            <td>
                                <span><?php esc_html_e( 'Experience' , 'grandpoza' ); ?></span>
                            </td>
                            <td><?php echo esc_attr($member["experience"]); ?></td>
                        </tr>
                        <tr>
                            <td>
                                <span><?php esc_html_e( 'Training' , 'grandpoza' ); ?></span>
                            </td>
                            <td><?php echo esc_attr($member["training"]); ?></td>
                        </tr>
                        <tr>
                            <td>
                                <span><?php esc_html_e( 'Phone' , 'grandpoza' ); ?></span>
                            </td>
                            <td><?php echo esc_attr($member["profile"]["phone"]); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <?php } ?>
</div>
