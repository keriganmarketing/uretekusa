/**
 * @param kappProject = {ajaxurl,label}
 */

(function ($) {

    'use strict';

    $(document).ready(function () {
        $(".ajax-load-projects-btn").click(function () {
            var btn = $(this);
            var btnLabel = $(btn).html();
            if ($(btn).attr("disabled")) return;
           
            $(this).html(kappProject.label + " ...");
            var post_count = $(".single-project-post").length;
            $.ajax({
                url: kappProject.ajaxurl,
                type: 'post',
                data: { action: "kapp_load_projects_ajax", template: $(btn).attr("data-template"), category: $(btn).attr("data-category"), offset: post_count, posts_to_pull: $(btn).attr("data-pull") },
                beforeSend:function(){
                    $(btn).attr("disabled", "disabled");
                },
                success: function (response) {
                    
                    if (response.length == 0 || response ==="0") {
                       
                        var msgContainer = $(".ajax-load-msg").length > 0 ? $(".ajax-load-msg") :  $('<div class="text-center ajax-load-msg color-mid">');
                        $(msgContainer).html(kappProject.no_posts_msg);
                       
                        $(btn).parent().prepend(msgContainer);
                        $(msgContainer).css({ "visibility": "visible" })
                        setTimeout(function () {
                            $(msgContainer).css({ "visibility": "hidden" })
                        }, 15000);

                        return;
                    }

                    var data = null;

                    data = $(response);
                    $(data).css({ "display": "none" });
                    $($(btn).attr("data-container")).append(data);
                    $(data).fadeIn(500);
                }
            }).done(function () {
                $(btn).html(btnLabel);
                $(btn).removeAttr("disabled");
            });
        });
    })
})(jQuery)