<div class="img-box">
    <img src="<?php echo esc_url($img); ?>" alt="">
</div>
<div class="text">
    <p><?php echo wp_kses_post($text); ?></p>
</div><br>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="inner-title">
            <h3><?php echo wp_kses_post($planing_title); ?></h3>
        </div>
        <div class="img-box">
            <img src="<?php echo esc_url($planing_img); ?>" alt="">
        </div>
        <div class="text">
            <p><?php echo wp_kses_post($planing_text); ?></p>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="inner-title">
            <h3><?php echo wp_kses_post($work_title); ?></h3>
        </div>
        <div class="img-box">
            <img src="<?php echo esc_url($work_img); ?>" alt="">
        </div>
        <div class="text">
            <p><?php echo wp_kses_post($work_text); ?></p>
        </div>
    </div>
</div>
<?php echo wp_kses_post($text2); ?>
