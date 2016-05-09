(function() {
  var app = angular.module('monitoringApp', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
  });

   app.controller('MainCtrl', function() {
    this.choices = [{id: 'choice1'}];
      
      this.addNewChoice = function() {
        var newItemNo = this.choices.length+1;
        this.choices.push({'id':'choice'+newItemNo});
      };
        
      this.removeChoice = function() {
        var lastItem = this.choices.length-1;
        if(lastItem!=0){
        	this.choices.splice(lastItem);
        }
        
      };
            
    });

  



})();