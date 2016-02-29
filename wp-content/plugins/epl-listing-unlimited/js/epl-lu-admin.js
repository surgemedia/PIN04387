jQuery(document).ready(function($) {

    if ($('input[name="epl_lu_upload_button"]').length > 0) {
		if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
		    $(document).on('click', 'input[name="epl_lu_upload_button"]', function(e) {
		        e.preventDefault();
		        var button = $(this);
		        var id = button.prev();
		        wp.media.editor.send.attachment = function(props, attachment) {
		        	console.log(attachment);
		            id.val(attachment.url);
		        };
		        wp.media.editor.open(button);
		        return false;
		    });
		}
	}
});
