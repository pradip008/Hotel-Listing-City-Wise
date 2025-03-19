jQuery(document).ready(function($) {
    function mediaUploader(button, input, imgPreview) {
        var mediaFrame;
        button.on("click", function(e) {
            e.preventDefault();
            if (mediaFrame) {
                mediaFrame.open();
                return;
            }
            mediaFrame = wp.media({
                title: "Select or Upload Image",
                library: { type: "image" },
                button: { text: "Use this Image" },
                multiple: false
            });
            mediaFrame.on("select", function() {
                var attachment = mediaFrame.state().get("selection").first().toJSON();
                input.val(attachment.url);
                imgPreview.attr("src", attachment.url).show();
            });
            mediaFrame.open();
        });
    }

    mediaUploader($(".upload_image_button"), $("#tim_cities_image"), $("#tim_cities_image_preview"));
});
