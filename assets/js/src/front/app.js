jQuery(function($){

  let
    filterType = $('#hegspots-filter__type'),
    filterActivity = $('#hegspots-filter__activity'),
    filterLocation = $('#hegspots-filter__location'),
    linkLoadMore = $('#hegspots-loadMoreLink')
  ;

  handleFilterReloading(filterType, 'type');
  handleFilterReloading(filterLocation, 'location');
  handleFilterReloading(filterActivity, 'activity');

  //linkLoadMore.on('click', loadMorePlaces);


  function loadMorePlaces(event){
    let
      link = event.target,
      url = link.href
    ;

    event.preventDefault();
    history.pushState({}, 'Test', url);

    return false;
  }

  function handleFilterReloading(filter, urlKey){

    filter.on('change', function(event){
      let
        key = urlKey,
        value = $(this).find('option:selected').val(),
        location = handlePaginationFromURL(updateUrlParameter(window.location.href, key, value))
      ;

      window.location.href = location;
    });

  }


  function handlePaginationFromURL(url){
    return updateUrlParameter(url, 'page', '1');
  }


  function updateUrlParameter(uri, key, value){
    // remove the hash part before operating on the uri
    var i = uri.indexOf('#');
    var hash = i === -1 ? ''  : uri.substr(i);
    uri = i === -1 ? uri : uri.substr(0, i);

    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    var separator = uri.indexOf('?') !== -1 ? "&" : "?";

    if (!value) {
      // remove key-value pair if value is empty
      uri = uri.replace(new RegExp("([?&]?)" + key + "=[^&]*", "i"), '');
      if (uri.slice(-1) === '?') {
        uri = uri.slice(0, -1);
      }
      // replace first occurrence of & by ? if no ? is present
      if (uri.indexOf('?') === -1) uri = uri.replace(/&/, '?');
    } else if (uri.match(re)) {
      uri = uri.replace(re, '$1' + key + "=" + value + '$2');
    } else {
      uri = uri + separator + key + "=" + value;
    }
    return uri + hash;
  }

});
