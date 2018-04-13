<?php

/**
 * CUSTOM JAVASCRIPT
 */
function grandpoza_custom_js()
{
    if(get_theme_mod("enable_custom_js")){
        echo html_entity_decode(get_theme_mod("header_js"));
    }
}

add_action("wp_head","grandpoza_custom_js");