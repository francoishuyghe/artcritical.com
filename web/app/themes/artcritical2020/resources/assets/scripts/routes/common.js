export default {
  init() {
    // JavaScript to be fired on all pages

	//Hamburger Menu
	$('.hamburger').on('click', function () {
		$('.banner').toggleClass('active');
		$(this).toggleClass('is-active');
	});

var expanded = new Array();

function tag_expand(tag, tagname){
	if(expanded[tag] == null || expanded[tag] == 'false'){
		new Ajax.Updater(tag + '_results','/tag.php',{
			onLoading:function(request){
				$(tag + '_loading').toggle();
			},
			onComplete:function(request){
				$(tag + '_loading').toggle();
				Effect.BlindDown(tag + '_results', {duration: 0.8});
				expanded[tag] = 'true';
			}, 
			parameters: {
				post_tag: tag,
				post_tag_name: tagname,
			}, evalScripts:true, asynchronous:true
		});	
	}else{
		Effect.BlindUp(tag + '_results', {duration: 0.8});
		expanded[tag] = 'false';
	}
	
}

var prev_id = 'bysubject';

function browse_tab(tab_id){
	$(tab_id).toggle();
	$(prev_id).toggle();
	$(tab_id + "_tab").toggleClassName("selected");
	$(prev_id + "_tab").toggleClassName("selected");
	prev_id = tab_id;
}
function relatedsuggested_tab(){
	$("tab_related").toggleClassName("selected");
	$("tab_suggested").toggleClassName("selected");
	$('related').toggle();
	$('suggested').toggle();
}
function recentsuggested_tab(){
	$("tab_recent").toggleClassName("selected");
	$("tab_suggested").toggleClassName("selected");
	$('recent').toggle();
	$('suggested').toggle();
}

var feature_prev_id = 1;
var is_fading = 'false';

function feature_tab_quick(tab_id, url){

	if(tab_id !== feature_prev_id){
		if(is_fading == 'false'){
			is_fading = 'true';
			$('feature_excerpt_' + tab_id).toggleClassName("selected");
			$('feature_excerpt_' + feature_prev_id).toggleClassName("selected");
			$('feature_image_' + feature_prev_id).fade({ duration: 0.5});
			$('feature_image_' + tab_id).appear({ 
				duration: 0.5,
				afterFinish: function () {is_fading = 'false'}
			});
			feature_prev_id = tab_id;
			count = tab_id + 1;
			if(count == 4){
				count = 1;
			}
		}
	}
	
}
function feature_tab_hover(tab_id){
	$('read_more_' + tab_id).toggle();
}
function expand_cover(){
	Effect.toggle('cover', 'blind', { duration: 0.5 });
	if(timeoutID){
		window.clearTimeout(timeoutID);
	}
}

var count = 2;

function tab_rotate(){
	feature_tab(count);
}
		let menuTimer;

		// main function to handle the mouse events //
		// $('.ddheader').on('mouseenter', function (e) {
		// 	var h = $(e.target);
		// 	var c = $('#' + h.attr('id') + '-ddcontent');
		// 		if (c.maxh && c.maxh <= c.offsetHeight) { return }
		// 		else if (!c.maxh) {
		// 			$('.ddcontent').removeClass('active')
		// 			c.addClass('active');
		// 		}
		// });
		
		// $('.ddheader').on('mouseleave', function (e) {
		// 	console.log('mouse left');
		// 	var h = $(e.target);
		// 	var c = $('#' + h.attr('id') + '-ddcontent');
		// 	menuTimer = setTimeout(function () {
		// 		c.removeClass('active')
		// 	}, 10);
		// });
  
		// $('.ddcontent').on('mouseenter mouseleave', function (e) {
		// 	if (e.type == 'mouseenter') {
		// 		clearTimeout(menuTimer);
		// 	} else {
		// 		console.log($(e.target));
		// 		$(e.target).closest('.ddcontent').removeClass('active');
		// 	 }
		// });

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
