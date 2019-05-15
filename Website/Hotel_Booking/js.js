var kidsarray = new Array();
kidsarray["0"]=0;
kidsarray["1"]=1;
kidsarray["2"]=2;
kidsarray["3"]=3;
kidsarray["4"]=4;
kidsarray["5"]=5;

var adultsarray = new Array();
adultsarray["0"]=0;
adultsarray["1"]=1;
adultsarray["2"]=2;
adultsarray["3"]=3;
adultsarray["4"]=4;
adultsarray["5"]=5;

function numberofkids(){
  var totalkids = 0;
  var theForm = document.forms["options_form"];
  var numberofkids = theForm.elements["kids"];
  for (var i=0; i<numberofkids.length; i++){
    if (numberofkids[i].checked) {
      totalkids = kidsarray[numberofkids[i].value];
      break;
    }
  }
  return totalkids;
}

function numberofadults(){
  var totaladults = 0;
  var theForm = document.forms["options_form"];
  var numberofadults = theForm.elements["adults"];
  for (var i=0; i<numberofadults.length; i++){
    if (numberofadults[i].checked) {
      totaladults = adultsarray[numberofadults[i].value];
      break;
    }
  }
  return totaladults;
}

function validate(){
var arrivaldate = document.getElementById("arrivaldate").value;
var departuredate = document.getElementById("departuredate").value;
var totalpeople = numberofkids()+numberofadults();

if(arrivaldate > departuredate){
  alert("Please choose appropriate dates.");
  return false;
}
else {

  if(numberofadults() == 0 || totalpeople >5){
    alert("Atleast one adult required and no more than 5 people in total.");
    return false;
  }
  else {
    return true;
  }
}
}
