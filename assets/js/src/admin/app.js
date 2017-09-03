jQuery(function($){

  var frame,
      // Member photo
      linkMemberPhoto  = $('#member__link__select-avatar'),
      inputMemberPhoto = $('#member__input__photo'),
      imgMemberPhoto   = $('#member__img__photo'),

      // Member cover
      linkMemberCover  = $('#member__link__select-cover'),
      inputMemberCover = $('#member__input__cover'),
      imgMemberCover   = $('#member__img__cover'),

      // Place photo
      linkPlacePhoto  = $('#place__link__select-photo'),
      inputPlacePhoto = $('#place__input__photo'),
      imgPlacePhoto   = $('#place__img__photo')
  ;


      if(linkMemberPhoto){
        attachToWpMedia(linkMemberPhoto, imgMemberPhoto, inputMemberPhoto);
      }

      if(linkMemberCover){
        attachToWpMedia(linkMemberCover, imgMemberCover, inputMemberCover);
      }

      if(linkPlacePhoto){
        attachToWpMedia(linkPlacePhoto, imgPlacePhoto, inputPlacePhoto);
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
