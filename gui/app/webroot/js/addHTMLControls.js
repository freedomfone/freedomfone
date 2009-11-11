var arrInput = new Array(0);

var arrInputValue = new Array(0);

function addInput() {
  arrInput.push(arrInput.length);
  arrInputValue.push("");
  display();
}

function display() {
  document.getElementById('parah').innerHTML="";
  for (intI=0;intI<arrInput.length;intI++) {
    document.getElementById('parah').innerHTML+=createInput(arrInput[intI], arrInputValue[intI]);
  }
}

function saveValue(intId,strValue) {
  arrInputValue[intId]=strValue;
}  

function createInput(id,value) {

    var key = id + 2;
    return "<table><tr><td>Option "+(key+1)+"</td><td><input type='text' id='Vote"+ key +"Chtext' name='data[Vote]["+ key +"][chtext]'  onChange='javascript:saveValue("+ id +",this.value)' value='"+ value +"'></td></tr></table>";
}

function deleteInput() {
  if (arrInput.length > 0) { 
     arrInput.pop(); 
     arrInputValue.pop();
  }
  display(); 
}