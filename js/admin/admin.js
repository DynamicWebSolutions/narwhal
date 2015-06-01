jQuery(document).ready(function($){

  var vargangrepp_frame;

  $('body').click(function(e) {
    var $this, preview, idField;

    $this = $(e.target);

    if (! $this.is('.vargangrepp-metabox .yogg-vargangrepp-button')) {
      return true;
    }

    preview  = $this.parent().find('.vargangrepp-preview');
    idField  = $this.parent().find('.vargangrepp-id');

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

      preview.html('');

      preview.append(img);

      idField.val(attachment.id);
    });

    //Open the uploader dialog
    vargangrepp_frame.open();

  });


  $('body').click(function(e) {
    var $this, preview, idField;

    $this = $(e.target);

    if (! $this.is('.vargangrepp-metabox .yogg-vargangrepp-button-remove')) {
      return true;
    }

    preview  = $this.parent().find('.vargangrepp-preview');
    idField  = $this.parent().find('.vargangrepp-id');

    preview.html('');
    idField.val(null);

    e.preventDefault();

  });
});