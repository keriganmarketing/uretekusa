<?php if ( ! defined( 'FW' ) ) {
          die( 'Forbidden' );
      }

      /**
       * @var array $atts
       */
?>

<div class="services-video-area text-center ptb-80">

    <div class="container">

        <div class="row mb-20">
            <div class="col-sm-8 col-sm-offset-2">
                <h2 class="h1 t-uppercase mb-20">
                    <?php echo esc_attr($atts["title"]); ?>
                    <span>
                        <?php echo esc_attr($atts["inner_title"]); ?>
                    </span>
                </h2>
                <p class="color-light font-15">
                    <?php echo $atts["description"]; ?>
                </p>
            </div>
        </div>

    </div>

    <div class="video-play-icon">
        <a class="iframe-lightbox video-link" href="<?php echo esc_url( $atts['url'] ); ?>"></a>
    </div>

</div>
