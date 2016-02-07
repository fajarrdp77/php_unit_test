<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>jQuery UI Slider - Slider scrollbar</title>
<?php include "Library.php"; ?>
	<style>
	.scroll-pane { overflow: auto; width: 99%; float:left; }
	.scroll-content { width: 10000px; float: left; }
	.scroll-content-item { width: 300px; height: 80 px; float: left; margin: 10px; font-size: 3em; line-height: 25px; text-align: center; }
	* html .scroll-content-item { display: inline; } /* IE6 float double margin bug */
	.scroll-bar-wrap { clear: left; padding: 0 4px 0 2px; margin: 0 -1px -1px -1px; }
	.scroll-bar-wrap .ui-slider { background: none; border:0; height: 2em; margin: 0 auto;  }
	.scroll-bar-wrap .ui-handle-helper-parent { position: relative; width: 100%; height: 100%; margin: 0 auto; }
	.scroll-bar-wrap .ui-slider-handle { top:.2em; height: 1.5em; }
	.scroll-bar-wrap .ui-slider-handle .ui-icon { margin: -8px auto 0; position: relative; top: 50%; }
	</style>
	<script>
	$(function() {
		//scrollpane parts
		var scrollPane = $( ".scroll-pane" ),
			scrollContent = $( ".scroll-content" );
		
		//build slider
		var scrollbar = $( ".scroll-bar" ).slider({
			slide: function( event, ui ) {
				if ( scrollContent.width() > scrollPane.width() ) {
					scrollContent.css( "margin-left", Math.round(
						ui.value / 100 * ( scrollPane.width() - scrollContent.width() )
					) + "px" );
				} else {
					scrollContent.css( "margin-left", 0 );
				}
			}
		});
		
		//append icon to handle
		var handleHelper = scrollbar.find( ".ui-slider-handle" )
		.mousedown(function() {
			scrollbar.width( handleHelper.width() );
		})
		.mouseup(function() {
			scrollbar.width( "200%" );
		})
		.append( "<span class='ui-icon ui-icon-grip-dotted-vertical'></span>" )
		.wrap( "<div class='ui-handle-helper-parent'></div>" ).parent();
		
		//change overflow to hidden now that slider handles the scrolling
		scrollPane.css( "overflow", "hidden" );
		
		//size scrollbar and handle proportionally to scroll distance
		function sizeScrollbar() {
			var remainder = scrollContent.width() - scrollPane.width();
			var proportion = remainder / scrollContent.width();
			var handleSize = scrollPane.width() - ( proportion * scrollPane.width() );
			scrollbar.find( ".ui-slider-handle" ).css({
				width: handleSize,
				"margin-left": -handleSize / 2
			});
			handleHelper.width( "" ).width( scrollbar.width() - handleSize );
		}
		
		//reset slider value based on scroll content position
		function resetValue() {
			var remainder = scrollPane.width() - scrollContent.width();
			var leftVal = scrollContent.css( "margin-left" ) === "auto" ? 0 :
				parseInt( scrollContent.css( "margin-left" ) );
			var percentage = Math.round( leftVal / remainder * 100 );
			scrollbar.slider( "value", percentage );
		}
		
		//if the slider is 100% and window gets larger, reveal content
		function reflowContent() {
				var showing = scrollContent.width() + parseInt( scrollContent.css( "margin-left" ), 10 );
				var gap = scrollPane.width() - showing;
				if ( gap > 0 ) {
					scrollContent.css( "margin-left", parseInt( scrollContent.css( "margin-left" ), 10 ) + gap );
				}
		}
		
		//change handle position on window resize
		$( window ).resize(function() {
			resetValue();
			sizeScrollbar();
			reflowContent();
		});
		//init scrollbar size
		setTimeout( sizeScrollbar, 10 );//safari wants a timeout
	});
	</script>
</head>
<body>

<div class="scroll-pane ui-widget ui-widget-header ui-corner-all">
	<div class="scroll-content">
		<div class="scroll-content-item ui-widget-header"><img src="Jasaaplikasi.jpg" width="300" height="250"></div>
		<div class="scroll-content-item ui-widget-header"><img src="Jasaaplikasi.jpg" width="300" height="250"></div>
		<div class="scroll-content-item ui-widget-header"><img src="Jasaaplikasi.jpg" width="300" height="250"></div>
		<div class="scroll-content-item ui-widget-header"><img src="Jasaaplikasi.jpg" width="300" height="250"></div>
		<div class="scroll-content-item ui-widget-header">5</div>
		<div class="scroll-content-item ui-widget-header">6</div>
		<div class="scroll-content-item ui-widget-header">7</div>
		<div class="scroll-content-item ui-widget-header">8</div>
		<div class="scroll-content-item ui-widget-header">9</div>
		<div class="scroll-content-item ui-widget-header">10</div>
		<div class="scroll-content-item ui-widget-header">11</div>
		<div class="scroll-content-item ui-widget-header">12</div>
		<div class="scroll-content-item ui-widget-header">13</div>
		<div class="scroll-content-item ui-widget-header">14</div>
		<div class="scroll-content-item ui-widget-header">15</div>
		<div class="scroll-content-item ui-widget-header">16</div>
		<div class="scroll-content-item ui-widget-header">17</div>
		<div class="scroll-content-item ui-widget-header">18</div>
		<div class="scroll-content-item ui-widget-header">19</div>
		<div class="scroll-content-item ui-widget-header">20</div>
	</div>
	<div class="scroll-bar-wrap ui-widget-content ui-corner-bottom">
		<div class="scroll-bar"></div>
	</div>
</div>

<div class="demo-description">
<p>Use a slider to manipulate the positioning of content on the page. In this case, it acts as a scrollbar with the potential to capture values if needed.</p>
</div>
</body>
</html>
