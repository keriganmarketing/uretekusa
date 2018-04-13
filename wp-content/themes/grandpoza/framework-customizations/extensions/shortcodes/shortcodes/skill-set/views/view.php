<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

?>

<div class="our-skills-area">
    <h3 class="pb-15 mb-40">
        <?php echo esc_attr($atts["title"]); ?>
    </h3>
    <ul class="skills-list">

        <?php foreach ( fw_akg( 'skills', $atts, array() ) as $skill ) {  ?>
        <li>
            <h6 class="mb-10">
                <?php echo esc_html($skill["skill_title"]); ?>
            </h6>
            <div class="skill-progress">
                <div class="skill-percentage" data-percent="<?php print is_numeric($skill["skill_percent"]) ? esc_attr( $skill["skill_percent"] ) : 0; ?>"></div>
            </div>
        </li>
        <?php } ?>
    </ul>
</div>