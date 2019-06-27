$(function () {

            var current_page_URL = location.href;

            $("a").each(function () {

                if ($(this).attr("href") !== "#") {

                    var target_URL = $(this).prop("href");

                    if (target_URL == current_page_URL) {

                        $('nav a').parents('li, ul').removeClass('active');

                        $(this).parent('li').addClass('active');

                        return false;

                    }

                }

            });

        });

$('li.dropdown ul').find('a').on('click', function() {
    window.location = $(this).attr('href');
});

$.fn.attachDragger = function(){
    var attachment = false, lastPosition, position, difference;
    $( $(this).selector ).on("mousedown mouseup mousemove mouseleave",function(e){
        if( e.type == "mousedown" ) attachment = true, lastPosition = [e.clientX, e.clientY];
        if( e.type == "mouseup" || e.type == "mouseleave" ) attachment = false;
        if( e.type == "mousemove" && attachment == true ){
            position = [e.clientX, e.clientY];
            difference = [ (position[0]-lastPosition[0]), (position[1]-lastPosition[1]) ];
            $(this).scrollLeft( $(this).scrollLeft() - difference[0] );
            $(this).scrollTop( $(this).scrollTop() - difference[1] );
            lastPosition = [e.clientX, e.clientY];
        }
    });
    $(window).on("mouseup", function(){
        attachment = false;
    });
}
$(".grid-container").attachDragger();


twttr.widgets.createTimeline(
  {
    sourceType: "list",
    ownerScreenName: "TwitterDev",
    slug: "national-parks"
  },
  document.getElementById("container")
);