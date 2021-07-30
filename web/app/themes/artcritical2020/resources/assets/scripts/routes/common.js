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

var prev_id = '#bysubject';

		$('.tab-link').on('click', function (e) {
			e.preventDefault();
			let tab_id = '#' + $(e.target).data('tab');
			$(tab_id).toggle();
			$(prev_id).toggle();
			$(tab_id + "_tab").toggleClass("selected");
			$(prev_id + "_tab").toggleClass("selected");
			prev_id = tab_id;
		})
		
function relatedsuggested_tab(){
	$("tab_related").toggleClass("selected");
	$("tab_suggested").toggleClass("selected");
	$('related').toggle();
	$('suggested').toggle();
}
function recentsuggested_tab(){
	$("tab_recent").toggleClass("selected");
	$("tab_suggested").toggleClass("selected");
	$('recent').toggle();
	$('suggested').toggle();
}

var feature_prev_id = 1;
var is_fading = 'false';

function feature_tab_quick(tab_id, url){

	if(tab_id !== feature_prev_id){
		if(is_fading == 'false'){
			is_fading = 'true';
			$('feature_excerpt_' + tab_id).toggleClass("selected");
			$('feature_excerpt_' + feature_prev_id).toggleClass("selected");
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

var count = 2;

function tab_rotate(){
	feature_tab(count);
}

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
