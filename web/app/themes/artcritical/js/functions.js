//Cufon.replace('h2');
//Cufon.replace('#menu li');
//Cufon.replace('.futura');
//Cufon.replace('.messagewidget');
//Cufon.replace('#cover_title');

var DDSPEED = 5;
var DDTIMER = 25;

// main function to handle the mouse events //
function ddMenu(id, d){
  var h = document.getElementById(id + '-ddheader');
  var c = document.getElementById(id + '-ddcontent');
  clearInterval(c.timer);
  if(d == 1){
    clearTimeout(h.timer);
    if(c.maxh && c.maxh <= c.offsetHeight){return}
    else if(!c.maxh){
      c.style.display = 'block';
      c.style.height = 'auto';
      c.maxh = c.offsetHeight;
      c.style.height = '0px';
    }
    c.timer = setInterval(function(){ddSlide(c,1)},DDTIMER);
  }else{
    h.timer = setTimeout(function(){ddCollapse(c)},50);
  }
}

// collapse the menu //
function ddCollapse(c){
  c.timer = setInterval(function(){ddSlide(c,-1)},DDTIMER);
}

// cancel the collapse if a user rolls over the dropdown //
function cancelHide(id){
  var h = document.getElementById(id + '-ddheader');
  var c = document.getElementById(id + '-ddcontent');
  clearTimeout(h.timer);
  clearInterval(c.timer);
  if(c.offsetHeight < c.maxh){
    c.timer = setInterval(function(){ddSlide(c,1)},DDTIMER);
  }
}

// incrementally expand/contract the dropdown and change the opacity //
function ddSlide(c,d){
  var currh = c.offsetHeight;
  var dist;
  if(d == 1){
    dist = (Math.round((c.maxh - currh) / DDSPEED));
  }else{
    dist = (Math.round(currh / DDSPEED));
  }
  if(dist <= 1 && d == 1){
    dist = 1;
  }
  c.style.height = currh + (dist * d) + 'px';
  c.style.opacity = currh / c.maxh;
  c.style.filter = 'alpha(opacity=' + (currh * 99 / c.maxh) + ')';
  if((currh < 2 && d != 1) || (currh > (c.maxh - 2) && d == 1)){
    clearInterval(c.timer);
  }
}

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
function neighborhood_expand(tag, tagname){
	if(expanded[tag] == null || expanded[tag] == 'false'){
		new Ajax.Updater(tag + '_results','http://testingartcritical.com/neighborhood.php',{
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
function expand_cover_cookie(){
	Effect.toggle('cover', 'blind', { duration: 1.5 });
	timeoutID = setTimeout(expand_cover, 10000);
}

var count = 2;

function tab_rotate(){
	feature_tab(count);
}

jQuery(document).ready(function() {  
  
    //Select all anchor tag with rel set to tooltip  
    jQuery('span[rel=tooltip]').mouseover(function(e) {  
          
        //Grab the title attribute's value and assign it to a variable  
        var tip = jQuery(this).attr('title');      
          
        //Remove the title attribute's to avoid the native tooltip from the browser  
        jQuery(this).attr('title','');  
          
        //Append the tooltip template and its value  
        jQuery(this).append('<div id="tooltip"><div class="tipHeader"></div><div class="tipBody">' + tip + '</div><div class="tipFooter"></div></div>');       
          
        //Set the X and Y axis of the tooltip  
        jQuery('#tooltip').css('top', e.pageY + 10 );  
        jQuery('#tooltip').css('left', e.pageX + 20 );  
          
        //Show the tooltip with faceIn effect  
        jQuery('#tooltip').fadeIn('500');  
        jQuery('#tooltip').fadeTo('10',0.8);  
          
    }).mousemove(function(e) {  
      
        //Keep changing the X and Y axis for the tooltip, thus, the tooltip move along with the mouse  
        jQuery('#tooltip').css('top', e.pageY + 10 );  
        jQuery('#tooltip').css('left', e.pageX + 20 );  
          
    }).mouseout(function() {  
      
        //Put back the title attribute's value  
        jQuery(this).attr('title',jQuery('.tipBody').html());  
      
        //Remove the appended tooltip template  
        jQuery(this).children('div#tooltip').remove();  
          
    });  
  
});


