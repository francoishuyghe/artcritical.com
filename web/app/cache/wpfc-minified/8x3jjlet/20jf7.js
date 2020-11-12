// source --> http://artcritical.test/app/themes/artcritical/js/app.js 
(function() {
  var app = angular.module('artCritical', []);

  app.controller('TabController', function(){
    this.tab = 1;

    this.setTab = function(newValue){
      this.tab = newValue;
    };

    this.isSet = function(tabName){
      return this.tab === tabName;
    };
  });

app.controller('dayController', function(){

    this.setDay = function(newValue){
      this.day = newValue;
    };

    this.setToday = function(Today){
      this.day = Today;
    };

    this.isSet = function(dayName){
      return this.day === dayName;
    };
  });



  app.directive("listingsWeek", function() {
    return {
      restrict: 'E',
      templateUrl: "<?php bloginfo('stylesheet_directory'); ?>/partials/listings-week.html"
    };
  });

})();