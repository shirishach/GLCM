var matrix;
var range = new Array(2);
var currentDiv="1";
var currentTheta="0";
var selectedPairs=[];

/* Function to generate matrix on page loading
   This function is executed only once in the application life cycle
   As soon as the page loads, the function fetches the existing
   matrix and its details for future processing */
function getMatrix()
{
    //Get matrix details from hidden field in the page
    var matrixData = document.getElementById("matrixDetail").value;
    matrixData = matrixData.split("-");

    //Extracting details from the fetched data
    var totalRows = parseInt(matrixData[0]);
    var totalCols = parseInt(matrixData[1]);
    range[0] = parseInt(matrixData[2]);
    range[1] = parseInt(matrixData[3]);
    var id=1;

    //Creating new array
    matrix = new Array(totalRows);

    for (var i = 0; i < matrix.length; i++) {
        matrix[i] = new Array(totalCols);
    }

    //Populate the array from matrix data
    for(var rowCnt=0;rowCnt<totalRows;rowCnt++)
    {
        for(var colCnt=0;colCnt<totalCols;colCnt++)
        {
            matrix[rowCnt][colCnt] = document.getElementById(id).innerHTML;
            id+=1;    
        }
    }
    
    //ajax call to get GLCM
    loadDoc();
}

/* Function to create AJAX call using POST method to fetch GLCM Matrix
    for existing image matrix */
function loadDoc() {

    //Converting existing image matrix to json
    var jString = JSON.stringify(matrix);
    var jRange = JSON.stringify(range);
    
    //Create XML HTTP Request Object
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("glcmArea").innerHTML = (this.responseText);
      }
    };

    //Making post request
    xhttp.open("POST", "result.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("matrix="+jString+"&range="+jRange+"&theta="+currentTheta+"&distance="+currentDiv);
  }

/* Function to highlight the selected pairs from the matrix */
function highlightPairs(event)
{
    //Deselect existing selection
    cleanHighlightedPairs();

    //Get pairs stored in GLCM matrix cell
    var id = event.target.id;
    var pairs = id.split("+");
    selectedPairs = pairs;
    
    //Highlight each pair
    for(var cnt=0;cnt<pairs.length-1;cnt++)
    {
        //Get cell id to highlight
        var numbers = pairs[cnt].split("-");

        //Generate Random color
        var colorCode = getRandomColor();

        //Highlight cell
        document.getElementById(numbers[0]).style.backgroundColor = colorCode;
        document.getElementById(numbers[1]).style.backgroundColor = colorCode;
    }
    
}

/* Function to deselect exiting highlighted pairs */
function cleanHighlightedPairs()
{
    for(var cnt=0;cnt<selectedPairs.length-1;cnt++)
    {
        var numbers = selectedPairs[cnt].split("-");

        document.getElementById(numbers[0]).style.backgroundColor = "white";
        document.getElementById(numbers[1]).style.backgroundColor = "white";
    }
}

/* Function to generate random color code */
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }

  /* Function to switch between distance button */
function switchDiv(id)
{
    //Get All button DOM objects
    var buttons = document.getElementsByClassName("distanceButton");

    //Reset color for all buttons
    for(var cnt=0;cnt<buttons.length;cnt++)
    {
        buttons[cnt].style.backgroundColor="blue";
    }
    //Set background color for selected button
    document.getElementById(id).style.backgroundColor="red";
    
    var temp = id.split("-");
    currentDiv = temp[1];

    //Make ajax call to update GLCM
    loadDoc();

}

/* Function to switch between theta buttons */
function switchTheta(id)
{
    //Get all theta button DOM objects
    var buttons = document.getElementsByClassName("thetaButton");

    //Reset background for all buttons
    for(var cnt=0;cnt<buttons.length;cnt++)
    {
        buttons[cnt].style.backgroundColor="blue";
    }

    //Set background for selected buttons
    document.getElementById(id).style.backgroundColor="red";

    var temp = id.split("-");
    currentTheta = temp[1];

    loadDoc();
}