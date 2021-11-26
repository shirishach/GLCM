<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>The Web App of GLCM</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body onload="getMatrix()">

<?php

    /* Function to generate image matrix */
    function generateMatrix($rows, $cols, $lowerBound, $upperBound)
    {
        $code="<div id='matrixArea'><table id='matrix'>";

        $elementCnt=1;
        for($rowCnt=0; $rowCnt<$rows; $rowCnt++)
        {
            $code .= "<tr>";

            for($colCnt=0; $colCnt<$cols; $colCnt++)
            {
                $rNumber = rand($lowerBound, $upperBound);
                $code .= "<td id='".$elementCnt."'>".$rNumber."</td>";
                $elementCnt = $elementCnt+1;
            }
            $code .= "</tr>";
        }

        $code .= "</table><input id='matrixDetail' type='text' value='".$rows."-".$cols."-".$lowerBound."-".$upperBound."' hidden /></div>";

        return $code;
    }

    $html = generateMatrix(5,6,1,8);

    echo $html;
?>

<div id="glcmArea">
</div>
<div class="distanceButtonArray" id="buttonArray1">
        <div id="distanceLabel"><h2>Select Distance</h2></div>
        <div id="div-1" class="distanceButton" onclick="switchDiv('div-1')">
            <div>1</div>
        </div>
        <div id="div-2" class="distanceButton" onclick="switchDiv('div-2')">
            <div>2</div>
        </div>
        <div id="div-3" class="distanceButton" onclick="switchDiv('div-3')">
            <div>3</div>
        </div>
    </div>
    <div class="distanceButtonArray" id="buttonArray2">
        <div id="thetaLabel"><h2>Select Theta</h2></div>
        <div id="div-0" class="thetaButton" onclick="switchTheta('div-0')">
            <div>0</div>
        </div>
        <div id="div-45" class="thetaButton" onclick="switchTheta('div-45')">
            <div>45</div>
        </div>
        <div id="div-90" class="thetaButton" onclick="switchTheta('div-90')">
            <div>90</div>
        </div>
        <div id="div-135" class="thetaButton" onclick="switchTheta('div-135')">
            <div>135</div>
        </div>
    </div>
</body>
</html>