The AdSupport Module includes a simple api to integrate ads into the player.

See an example page: [Ad Events Test](http://www.kaltura.org/apis/stagingHtml5lib/modules/AdSupport/tests/Ad_Events_test.html).

### JSON format ad insertion API
 
    var adconf = [{
    
      // Set of ads to chose from
      ads : [{
        id : 0, //{ Add id}
        videoFile : "http://example.com/video.webm" // {URL} video source to play for the ad
        duration : 15, // {Number} duration of ad in seconds
     
        // Impression fired at start of ad display
        impressions: [
          beaconUrl : "http://example.com" // {URL}
        ]
      
        // Tracking events sent for video playback
        trackingEvents : [
          beaconUrl : "http://example.com", // {URL}
          eventName : "ping", // {String} Event name per VAST definition of video ad
          playback : "start" // {String} start, midpoint, etc.
        ]
    
        // NonLinear list of overlays
        nonLinear : [{
          width : 480, // {Number} width
          height : 80, // {Number} height
          VASThtml : "<p>Overlay Text</p>" //{String} html
        }]
      
        companions : [{
          id : 0, // {Number} index of companion target 
          html : "<p>Companion is active</p>" // {String} html text to set innerHTML of companion target
        }],
      }],
      
      // List of companion targets
      companionTargets : [{
        elementid : "companionTarget", // {String} id of elementidment
        height : {Number} height of companion target
        type : {String} Companion target type ( html in mobile ) 
      }]
    }];
     
    mw.addAdToPlayerTimeline( embedPlayer, ['preroll', 'bumper','overlay', 'postroll'], adConf

### Loading Ads in VAST format

If you ad service is in VAST format you can use the VAST loader and parser. This loads the ad data over the jsonp xml proxy 

    mw.AdLoader.load( "http://example.com/vast.xml", function( adConf ){
      // Now you can call addAdToPlayerTimeline with the adConf
      mobilew.addAdToPlayerTimeline( embedPlayer, ['preroll', 'bumper', 'overlay', 'postroll'], adConf );
    });
