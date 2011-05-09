<script language='JavaScript' type='text/javascript'>
<!--

// Global variables
cal_xMousePos = 0; // Horizontal position of the mouse on the screen
cal_yMousePos = 0; // Vertical position of the mouse on the screen
cal_xMousePosMax = 0; // Width of the page
cal_yMousePosMax = 0; // Height of the page

function captureMousePosition(e) {
    if (document.layers) {
        // When the page scrolls in Netscape, the event's mouse position
        // reflects the absolute position on the screen. innerHight/Width
        // is the position from the top/left of the screen that the user is
        // looking at. pageX/YOffset is the amount that the user has
        // scrolled into the page. So the values will be in relation to
        // each other as the total offsets into the page, no matter if
        // the user has scrolled or not.
        cal_xMousePos = e.pageX;
        cal_yMousePos = e.pageY;
        cal_xMousePosMax = window.innerWidth+window.pageXOffset;
        cal_yMousePosMax = window.innerHeight+window.pageYOffset;

    } else if (document.all && document.compatMode == "CSS1Compat") {

        // When the page scrolls in IE, the event's mouse position
        // reflects the position from the top/left of the screen the
        // user is looking at. scrollLeft/Top is the amount the user
        // has scrolled into the page. clientWidth/Height is the height/
        // width of the current page the user is looking at. So, to be
        // consistent with Netscape (above), add the scroll offsets to
        // both so we end up with an absolute value on the page, no
        // matter if the user has scrolled or not.
        cal_xMousePos = window.event.x+document.documentElement.scrollLeft;
        cal_yMousePos = window.event.y+document.documentElement.scrollTop;
        cal_xMousePosMax = document.body.clientWidth+document.documentElement.scrollLeft;
        cal_yMousePosMax = document.body.clientHeight+document.documentElement.scrollTop;

    } else if(document.all) {

        // When the page scrolls in IE, the event's mouse position
        // reflects the position from the top/left of the screen the
        // user is looking at. scrollLeft/Top is the amount the user
        // has scrolled into the page. clientWidth/Height is the height/
        // width of the current page the user is looking at. So, to be
        // consistent with Netscape (above), add the scroll offsets to
        // both so we end up with an absolute value on the page, no
        // matter if the user has scrolled or not.
        cal_xMousePos = window.event.x+document.body.scrollLeft;
        cal_yMousePos = window.event.y+document.body.scrollTop;
        cal_xMousePosMax = document.body.clientWidth+document.body.scrollLeft;
        cal_yMousePosMax = document.body.clientHeight+document.body.scrollTop;


    } else if (document.getElementById) {
        // Netscape 6 behaves the same as Netscape 4 in this regard
        cal_xMousePos = e.pageX;
        cal_yMousePos = e.pageY;
        cal_xMousePosMax = window.innerWidth+window.pageXOffset;
        cal_yMousePosMax = window.innerHeight+window.pageYOffset;
    }

    }

if (document.layers) { // Netscape
    document.captureEvents(Event.MOUSEMOVE);
    document.onmousemove = captureMousePosition;
} else if (document.all) { // Internet Explorer
    document.onmousemove = captureMousePosition;
} else if (document.getElementById) { // Netcsape 6
    document.onmousemove = captureMousePosition;
}

// -->
</script>
