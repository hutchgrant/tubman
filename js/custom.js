jQuery(document).ready(function ($) {

var numRows = 0, numTop = 0;

numRows = $('.research .row').length;
numTop = $('.research .circle').length; 

var clickArr = [];
for(i = 0; i< numTop; i++){
	clickArr[i] = 0;
}

hideAll();
drawSpacers();

/// Get Menu ID, extract position
$(".RB").click(function(event){
	var pos = this.id.substring(2,3);
	popout(pos);
})
// detect width change
var width = $(window).width();
$(window).resize(function(){
   if($(this).width() != width){
      width = $(this).width();
      drawSpacers();
   }
});
// initiate popout animation event
function popout(pos){
	var currentRow = Math.floor(pos / 2);
	var circle = "#RB"+pos;
	var rspaceL = "#rspaceL"+currentRow;
	var rspaceM = "#rspaceM"+currentRow;
	var rspaceR = "#rspaceR"+currentRow;
	var rblistL = rspaceM + " .RBList";
	var rblistR = rspaceR + " .RBList";
	var rblines = "#RBLines"+pos;

	if(pos % 2 != 0){
		if(clickArr[pos] == 0){
			disablePop(); // set back to default positions
			$(rblistR).show();
			// Get Num List Items
			var numItems = $('.research '+rblistR+' li').length;
			// Draw Lines
			drawLines("RBLines"+pos, numItems, rspaceR);
			// Move right circle out
			$(circle).addClass("col-lg-2").removeClass("col-lg-3");
			$(rspaceM).addClass("col-lg-1").removeClass("col-lg-2");
			$(rspaceR).addClass("col-lg-4").removeClass("col-lg-2");
			clickArr[pos] = 1;
		}else{
			// Return clicked circle black to position
			$(circle).addClass("col-lg-3").removeClass("col-lg-2");
			$(rspaceM).addClass("col-lg-2").removeClass("col-lg-1");
			$(rspaceR).addClass("col-lg-2").removeClass("col-lg-4");
			clickArr[pos] = 0;
			$(rblistR).hide();
			$(rblines).hide();
		}
	}else{
		if(clickArr[pos] == 0){
			disablePop(); // set back to default positions			
			$(rblistL).show();
			// Get Num List Items
			var numItems = $('.research '+rblistL+' li').length;
			// Draw Lines
			drawLines("RBLines"+pos, numItems, rspaceM);
			// move left circle out
			$(circle).addClass("col-lg-2").removeClass("col-lg-3");
			$(rspaceL).addClass("col-lg-1").removeClass("col-lg-2");
			$(rspaceM).addClass("col-lg-4").removeClass("col-lg-2");
			$(rspaceR).addClass("col-lg-1").removeClass("col-lg-2");

			clickArr[pos] = 1;
		}else{
			// Return clicked circle black to position
			$(circle).addClass("col-lg-3").removeClass("col-lg-2");
			$(rspaceL).addClass("col-lg-2").removeClass("col-lg-1");
			$(rspaceM).addClass("col-lg-2").removeClass("col-lg-4");
			$(rspaceR).addClass("col-lg-2").removeClass("col-lg-1");
			clickArr[pos] = 0;
			$(rblistL).hide();
			$(rblines).hide();
		}
	}
}

// hide all sub-menu lines
function hideAll(){
	$(".RBList").hide();
}

// move all back to default position
function disablePop(){
	for(i = 0; i< numTop; i++){
		clickArr[i] = 1;
		popout(i);
	}
	hideAll();
}
// draw spacers for responsive view
function drawSpacers(){
	if($(window).width() <= 1201){ //1201
		$(".seperator").show();
		$(".mobSpacer").show();
	}else{
		$(".seperator").hide();
		$(".mobSpacer").hide();
	}
}
// Determine if list item is larger than 1 line
function calcItemSize(id, itemPos){
	var itemHeight = 0;
	var itemID = ""; 
	itemID = id + " > .RBList > a:eq("+itemPos+") > li:nth-child(1)";
	itemHeight = $(itemID).height();
	if(itemHeight > 29){
		return 1;
	}
	else{
		return 0;
	}
}

// draw sub-menu lines
function drawLines(cID, numItems, listID){
	var mID = "#"+cID;
	if($(window).width() >= 990){ //1201

		var addedHeight = 0; // if > 0 additional height added to beginning
		var itemDbl = 0; // if flagged, item is more than 1 line in height
		var dblCatCount = 0; // num dbl spaced subcategories
		var prevItemDbl = 0; // set additional space because prev item was dbl spaced
		var DblToggle = 0 // toggle prev item was dbl
		var prevCatCount = 0; //num dbl spaced cat in first 3 items
		var prevPos = 0;
		$(mID).show();

		var c=document.getElementById(cID);
		var ctx=c.getContext("2d");
		// ctx.scale(0.9,0.70);
		ctx.beginPath();
		ctx.lineWidth=15;

		for(count=0; count < numItems; count++){
			itemDbl = calcItemSize(listID, count);
			if(itemDbl == 1){
				addedHeight = 10 + addedHeight;
				dblCatCount++;
				if(DblToggle > 0){
					prevItemDbl = 20
				}else{
					prevItemDbl = 10;
				}
			}
			/// left line default
			if(numItems != 0 && count == 0){
				/// left line
				ctx.moveTo(100, 9+addedHeight);
				ctx.lineTo(100, 61);
				ctx.stroke();

				ctx.beginPath();
				ctx.lineWidth=2;
				// connect to category item
				ctx.moveTo(100, 60);
				ctx.lineTo(10, 60);
				ctx.stroke();
				prevPos = 61;
			}
			/// left line extend
			if(numItems > 2 && count == 2 && addedHeight > 0){
				 ctx.beginPath();
				ctx.lineWidth=15;
				/// left line
				ctx.moveTo(100, prevPos);
				ctx.lineTo(100, prevPos+addedHeight-8);
				ctx.stroke(); 
				prevPos = prevPos + addedHeight -8; 
				prevCatCount = dblCatCount;
			}
			if(numItems > 3 && count > 2){
				ctx.beginPath();
				ctx.lineWidth=15;
				/// left line extend
				ctx.moveTo(100, prevPos);
				if(count == 3){
					if(prevCatCount == 0){
						prevPos = prevPos+ 13 + prevItemDbl;
					}else if(prevCatCount == 1){
						prevPos = prevPos+ 13 + (8 * prevCatCount) + prevItemDbl;
					}else if(prevCatCount == 2){
						prevPos = prevPos+ 13 + (4 * prevCatCount) + prevItemDbl;
					}else{
						prevPos = prevPos+ 13 + (2 * prevCatCount) + prevItemDbl;
					}
				}else{
					if(prevCatCount == 0){
						prevPos = prevPos+ 21 + prevItemDbl;
					}else if(prevCatCount == 1){
						prevPos = prevPos+ 13 + (8 * prevCatCount) + prevItemDbl;
					}else if(prevCatCount == 2){
						prevPos = prevPos+ 13 + (4 * prevCatCount) + prevItemDbl;
					}else{
						prevPos = prevPos+ 13 + (2 * prevCatCount) + prevItemDbl;
					}
				}

				ctx.lineTo(100, prevPos);
				ctx.stroke();  
			}
			ctx.beginPath();
			ctx.lineWidth=2;
			//  Each subcategory
			ctx.moveTo(100,10+(20*count)+count+addedHeight);
			ctx.lineTo(250, 10+(20*count)+count+addedHeight);

			// draw arrow
			ctx.moveTo(250, 10+(20*count)+count+addedHeight);
			ctx.lineTo(230, 13+(20*count)+count+addedHeight);

			ctx.moveTo(250, 10+(20*count)+count+addedHeight);
			ctx.lineTo(230, 7+(20*count)+count+addedHeight);
			ctx.stroke();
			if(itemDbl == 1){
				addedHeight = addedHeight+ 10;
				DblToggle = 1;
				prevItemDbl = 10;
			}else{
				DblToggle = 0;
				prevItemDbl = 0;
			}
			itemDbl = 0;
		}
	}else{
		$(mID).hide();	
	}
}

});