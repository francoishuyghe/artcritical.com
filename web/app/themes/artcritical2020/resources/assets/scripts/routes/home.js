export default {
  init() {
    // JavaScript to be fired on the home page
    function expand_cover_cookie(){
      Effect.toggle('cover', 'blind', { duration: 1.5 });
      timeoutID = setTimeout(expand_cover, 10000);
    }
    
    document.observe("dom:loaded", function() {
      setTimeout(expand_cover_cookie, 600);
    });	
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
