define(['jquery', 'TYPO3/CMS/Recordlist/LinkBrowser'], function($, LinkBrowser) {
  'use strict';

  var demandLinkHandler = {};

  demandLinkHandler.createMyLink = function() {
    var val = $('.myElmeent').val(); // Example

    LinkBrowser.finalizeFunction('t3://demander?' + val); // Example
  };

  demandLinkHandler.initialize = function() {
    // Catch page click
    $('.t3js-pageLink').on('click', function (e) {
      e.preventDefault();

      console.log($(this).attr('href')); // TODO: Process demand configuration for selected page
    })

    // TODO: add necessary event handlers, which will propably call demandLinkHandler.createMyLink
  };

  $(demandLinkHandler.initialize);

  return demandLinkHandler;
});
