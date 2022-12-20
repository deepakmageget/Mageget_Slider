require([
    "jquery","owlCarousel"
    ], function($,owlCarousel){
    $(document).ready(function() {
        console.log("Hello");
        
        jQuery("#carousel").owlCarousel({
            autoplay: true,
            rewind: true, /* use rewind if you don't want loop */
            margin: 0,
             /*
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            */
            responsiveClass: true,
            autoHeight: true,
            autoplayTimeout: 7000,
            smartSpeed: 800,
            nav: true,
            responsive: {
              0: {
                items: 1
              },
          
              600: {
                items: 3
              },
          
              1024: {
                items: 4
              },
          
              1366: {
                items: 1
              }
            }
          }); 

          jQuery("#bestseler-slider,#recentviewSlider,#AllProductslider,#RecentViewslider").owlCarousel({
            items : 8,
            itemsDesktop:[1199,3],
            itemsDesktopSmall:[980,2],
            itemsMobile : [600,1],
            navigation:true,
            navigationText:["",""],
            pagination:true,
            autoPlay:true,
            loop:true,
            autoplay:true,
            autoplayTimeout:1000,
            autoplayHoverPause:true,
            responsive: {
              0: {
                items: 1
              },
          
              600: {
                items: 3
              },
          
              1024: {
                items: 4
              },
          
              1366: {
                items: 8
              }
            }
        });

    });
   });