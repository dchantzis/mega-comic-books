function newImage(arg) 
{
	if (document.images) {
		rslt = new Image();
		rslt.src = arg;
		return rslt;
	}
}

function changeImages() 
{
	if (document.images && (preloadFlag == true)) {
		for (var i=0; i<changeImages.arguments.length; i+=2) {
			document[changeImages.arguments[i]].src = changeImages.arguments[i+1];
		}
	}
}

var preloadFlag = false;
function preloadImages() 
{
	if (document.images) {
		butt_01_over = newImage("images/butt_01_over.gif");
		butt_02_over = newImage("images/butt_02_over.gif");
		butt_03_over = newImage("images/butt_03_over.gif");
		butt_04_over = newImage("images/butt_04_over.gif");
		preloadFlag = true;
	}
}

