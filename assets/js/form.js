jQuery(document).ready(function ($) {

    // Uploader
    var background_uploader;
    $('#employee_avatar_select').click(function () {
        if(background_uploader !== undefined) {
            background_uploader.open();
            return;
        }
        background_uploader = wp.media({
            title: 'Select background image',
            button: {
                text: 'Select',
            },
            // multiple: true,
            library: {
                type: 'image',
                // type: ['image', 'audio', 'video'],
            }
        });
        background_uploader.on('select', function () {
            let selected = background_uploader.state().get('selection').first().toJSON().url;
            console.log(selected);
            $('#avatar').val(selected);
            $('#background-preview').attr('src',selected)
        });

        background_uploader.open();
    });



});