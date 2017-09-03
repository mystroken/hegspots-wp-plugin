jQuery(function($){

  var frame,
      // Member photo
      linkPhoto = $('#link__select-avatar'),
      inputPhoto = $('#input__photo'),
      imgPhoto = $('#img__photo'),

      // Member cover
      linkCover = $('#link__select-cover'),
      inputCover = $('#input__cover'),
      imgCover = $('#img__cover')
  ;


      if(linkPhoto){
        attachToWpMedia(linkPhoto, imgPhoto, inputPhoto);
      }

      if(linkCover){
        attachToWpMedia(linkCover, imgCover, inputCover);
      }




      function attachToWpMedia(Link, Img, Input) {
        Link.on('click', function(event){
          event.preventDefault();


          // Create a new media frame
          frame = wp.media({
            title: 'Select or Upload Media of your choice',
            button: {
              text: 'Use this media'
            },
            multiple: false
          });

          frame.on('select', function(){
            let attachment = frame.state().get('selection').first().toJSON();

            Img.attr('src', attachment.url);
            Input.attr('value', attachment.url);
          });

          // Finally, open the modal on click
          frame.open();

        });
      }

});
