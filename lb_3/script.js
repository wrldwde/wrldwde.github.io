function generatingData() {
    var Interval = document.getElementById('inputtedInterval').value;
    var randTable = document.createElement("TABLE");
    randTable.setAttribute("id", "randomTable" + getRandomInt(99999));
    document.body.appendChild(randTable);

    var firstRow = randTable.insertRow(0);
    var firstCell = firstRow.insertCell(0);
    var headerText = document.createTextNode("Header row!");
    firstCell.appendChild(headerText);
    var i = 1;


function insertingRows(tableId) {
    if(i > getRandomInt(100)){
        clearInterval(timeoutID);
        return;
    }else{
        var tempRow = document.getElementById(tableId).insertRow(i);
        if(i++%2 == 0){
            tempRow.style.backgroundColor = "red";
        }else{
            tempRow.style.backgroundColor = "green";
        }
        var tempCell = tempRow.insertCell(0);
        var randData = document.createTextNode(makeid());
        tempCell.appendChild(randData);
        }
    }
    let timeoutID = setInterval(() => insertingRows(randTable.getAttribute("id")), Interval*1000);

}
function getRandomInt(max) {
    return Math.floor(Math.random() * Math.floor(max));
}
function makeid()
{
    var text = "";
    var possible = "abcdefghijklmnopqrstuvwxyz";

    for( var i=0; i < getRandomInt(15); i++ )
        text += possible.charAt( getRandomInt(possible.length));

    return text;
}