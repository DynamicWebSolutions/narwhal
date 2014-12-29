jQuery(document).ready(function($){
 
    var vargangrepp_frame;
 
    $('#yogg-vargangrepp-button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (vargangrepp_frame) {
            vargangrepp_frame.open();
            return;
        }
 
        //Extend the wp.media object
        vargangrepp_frame = wp.media.frames.vargangrepp_frame = wp.media({
            title: 'Choose your Vargangrepp',
            button: {
                text: 'Select Vargangrepp'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        vargangrepp_frame.on('select', function() {
           var attachment = vargangrepp_frame.state().get('selection').first().toJSON();
           var container = $('#vargangrepp-preview');
           
           if(attachment.sizes.thumbnail){
               var attrs = {
                    src: attachment.sizes.thumbnail.url,
                    width: attachment.sizes.thumbnail.width,
                    height: attachment.sizes.thumbnail.height
               }
           }else {
               var attrs = {
                    src: attachment.sizes.full.url
               }           
           
           }
           var img = $('<img>').attr(attrs);
            
            container.html('');
            
            container.append(img);
            
            $('#vargangrepp-id').val(attachment.id);
        });
 
        //Open the uploader dialog
        vargangrepp_frame.open();
 
    });
 
 
});