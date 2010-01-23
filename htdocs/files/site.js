$(function($) {
   var options = {
        timeNotation: '12h',
        am_pm: true,     
        fontSize: '12px'
      }; 
   $('.jclock').jclock(options);
});

// Scroll window to a chosen html element
function ScrollToElement(theElement) {
  var selectedPosX = 0;
  var selectedPosY = 0;

  while (theElement != null) {
    selectedPosX += theElement.offsetLeft;
    selectedPosY += theElement.offsetTop;
    theElement = theElement.offsetParent;
  }
window.scrollTo(selectedPosX, selectedPosY);
}

$(document).ready(function(){

	$('.ajax').ajaxContent({
			loaderType:'img',
			loadingMsg:'files/orange_loading.gif',
			target:'#ajaxcontent',
			success: function(obj,target,msg){
// 			  ScrollToElement(document.getElementById('ajaxContent2'));
			}
		});
});