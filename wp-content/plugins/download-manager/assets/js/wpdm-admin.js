var allps;

jQuery(function($){

    // Uploading files
    var file_frame, dfield;

    $('body').on('click', '.btn-media-upload' , function( event ){
        event.preventDefault();
        dfield = $($(this).attr('rel'));

        // If the media frame already exists, reopen it.
        if ( file_frame ) {
            file_frame.open();
            return;
        }

        // Create the media frame.
        file_frame = wp.media.frames.file_frame = wp.media({
            title: $( this ).data( 'uploader_title' ),
            button: {
                text: $( this ).data( 'uploader_button_text' )
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });

        // When an image is selected, run a callback.
        file_frame.on( 'select', function() {
            // We set multiple to false so only get one image from the uploader
            attachment = file_frame.state().get('selection').first().toJSON();
            dfield.val(attachment.url);

        });

        // Finally, open the modal
        file_frame.open();
    });

    allps = $('#pps_z').val();
    if(allps == undefined) allps = '';
    $('#ps').val(allps.replace(/\]\[/g,"\n").replace(/[\]|\[]+/g,''));
    shuffle = function(){
        var sl = 'abcdefghijklmnopqrstuvwxyz';
        var cl = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var nm = '0123456789';
        var sc = '~!@#$%^&*()_';
        ps = "";
        pss = "";
        if($('#ls').attr('checked')=='checked') ps = sl;
        if($('#lc').attr('checked')=='checked') ps += cl;
        if($('#nm').attr('checked')=='checked') ps += nm;
        if($('#sc').attr('checked')=='checked') ps +=sc;
        var i=0;
        while ( i <= ps.length ) {
            $max = ps.length-1;
            $num = Math.floor(Math.random()*$max);
            $temp = ps.substr($num, 1);
            pss += $temp;
            i++;
        }

        $('#ps').val(pss);


    };
    $('#gps').click(shuffle);

    $('body').on('click', '#gpsc', function(){
        var allps = "";
        shuffle();
        for(k=0;k<$('#pcnt').val();k++){
            allps += "["+randomPassword(pss,$('#ncp').val())+"]";

        }
        vallps = allps.replace(/\]\[/g,"\n").replace(/[\]|\[]+/g,'');
        $('#ps').val(vallps);

    });

    $('body').on('click', '#pins', function(){
        var aps;
        aps = $('#ps').val();
        aps = aps.replace(/\n/g, "][");
        allps = "["+aps+"]";
        $($(this).data('target')).val(allps);
        tb_remove();
    });


});

function randomPassword(chars, size) {

    //var size = 10;
    if(parseInt(size)==Number.NaN || size == "") size = 8;
    var i = 1;
    var ret = "";
    while ( i <= size ) {
        $max = chars.length-1;
        $num = Math.floor(Math.random()*$max);
        $temp = chars.substr($num, 1);
        ret += $temp;
        i++;
    }
    return ret;
}