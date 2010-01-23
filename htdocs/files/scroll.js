var timeout;
var delay = 10;

function recScroll(elementId, direction, speed) {
  clearTimeout(timeout);
  var intElemScrollTop = window.document.getElementById(elementId).scrollTop;
  if (direction == 'down') {
    window.document.getElementById(elementId).scrollTop = intElemScrollTop + speed;
  } else {
    window.document.getElementById(elementId).scrollTop = intElemScrollTop - speed;
  }
  if (intElemScrollTop != window.document.getElementById(elementId).scrollTop ) {
    timeout=setTimeout("recScroll('"+elementId+"', '"+direction+"', "+speed+");",delay);
  } else {
    recScrollLimit(elementId,direction);
  }
}
function recScrollStop() {
  clearTimeout(timeout);
}
function recScrollLimit(elementId, direction) {
  //alert("You can't keep scrolling "+elementId+" "+direction+".");
}

function recScrollBy(elementId, direction, pixels, speed) {
  clearTimeout(timeout);
  if (pixels > 0) {
    var intElemScrollTop = window.document.getElementById(elementId).scrollTop;
    if (direction == 'down') {
      window.document.getElementById(elementId).scrollTop = intElemScrollTop + speed;
    } else {
      window.document.getElementById(elementId).scrollTop = intElemScrollTop - speed;
    }
    pixels = pixels - speed;
    timeout=setTimeout("recScrollBy('"+elementId+"', '"+direction+"', "+pixels+", "+speed+");",delay);
  }
}

function scrollWheel(event){
  var delta = 0;
  var pixelsPerEvent = 40;
  var elementId = 'thumbnails';

  /* Delta is a multiple of 120 (except for Mozilla where it is a multiple of 3) */
  /* In Opera and Mozilla the delta is negative compared to IE. */
  if (!event) /* Get the event for IE. */
    event = window.event;
  if (event.wheelDelta) { /* IE/Opera. */
    delta = event.wheelDelta/120;
    if (window.opera)
      delta = -delta;
  } else if (event.detail) { /* Mozilla */
    /* I'm not going to divide by 3 since Mozilla's scrolling is so slow. */
     delta = -event.detail;
  }

  /* Act if delta != 0 */
  if (delta) {
    if (delta < 0) {
      direction = 'down';
      delta = -delta;
    } else {
      direction = 'up';
    }
    pixels = pixelsPerEvent * delta;
    speed = delta * 5;
    //alert("Scrolling "+elementId+" "+direction+" by "+pixels); /* for debugging */
    recScrollBy(elementId,direction,delta,speed);
  }
}

/* Initialization code. */
/* Mozilla browsers use DOMMouseScroll which listens for scrolling _anywhere_ on the window */
if (window.addEventListener)
  window.addEventListener('DOMMouseScroll', scrollWheel, false);

/* The following will listen for scrolling _anywhere_ in the window */
/* It is therefore preferable to assign this as an event for the area you wish to scroll */
/* e.g. <DIV ID="thumbnails" onmousewheel="wheel()"> */
//window.onmousewheel = document.onmousewheel = scrollWheel;