var app=angular.module('lifeApp',['ngSanitize']);

app.controller('CompareLifeController',function($http){
	var clc=this;

	var date=new Date();

	//GET CURRENT YEAR
	clc.currYear=date.getFullYear();

	//GET DATA AND CREATE AN OBJECT
	$http.get('scripts/life-table.php').then(function(response){
		clc.lifeTable=response.data.records;
	});
});