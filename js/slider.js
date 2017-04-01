jQuery(document).ready(function ($) {
    
  var jssor_1_SlideoTransitions = [
    [{b:-1,d:1,o:-1},{b:0,d:1000,o:1}],
    [{b:1900,d:2000,x:-379,e:{x:7}}],
    [{b:1900,d:2000,x:-379,e:{x:7}}],
    [{b:-1,d:1,o:-1,r:288,sX:9,sY:9},{b:1000,d:900,x:-1400,y:-660,o:1,r:-288,sX:-9,sY:-9,e:{r:6}},{b:1900,d:1600,x:-200,o:-1,e:{x:16}}]
  ];

  var _SlideshowTransitions = [
    { $Duration:1200,$Opacity:2 },
    { $Duration:1000,y:4,$Zoom:11,$Easing:{$Top:$JssorEasing$.$EaseInCubic,$Zoom:$JssorEasing$.$EaseInCubic,$Opacity:$JssorEasing$.$EaseOutQuad},$Opacity:2 },
    { $Duration:500,y:1,$Easing:$JssorEasing$.$EaseInQuad },
    { $Duration:400,x:1,$Easing:$JssorEasing$.$EaseInQuad }
  ];
  
  var jssor_1_options = {
    $AutoPlay: true,
    $PauseOnHover: 3,
    $ArrowNavigatorOptions: {
      $Class: $JssorArrowNavigator$
    },
    $SlideshowOptions: {
          $Class: $JssorSlideshowRunner$,
          $Transitions: _SlideshowTransitions,
          $TransitionsOrder: 1,
          $ShowLink: true
      }
  };
  if ( $( "#slider1_container" ).length ) {
  var jssor_1_slider = new $JssorSlider$("slider1_container", jssor_1_options);
 
  //responsive code begin
  //you can remove responsive code if you don't want the slider scales while window resizing
  function ScaleSlider() {
      var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
      if (refSize) {
          refSize = Math.min(refSize, 1920);
          jssor_1_slider.$ScaleWidth(refSize);
      }
      else {
          window.setTimeout(ScaleSlider, 30);
      }
  }
  ScaleSlider();
  $(window).bind("load", ScaleSlider);
  $(window).bind("resize", ScaleSlider);
  $(window).bind("orientationchange", ScaleSlider); 
 }
});