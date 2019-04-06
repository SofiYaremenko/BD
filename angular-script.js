// Application module
var crudApp = angular.module('crudApp',[]);
crudApp.controller("DbController",['$scope','$http', function($scope,$http){

// Function to get employee details from the database
getInfo();
function getInfo(){
// Sending request to EmpDetails.php files
$http.post('databaseFiles/empDetails.php').success(function(data){
// Stored the returned data into scope
$scope.details = data;
});
}