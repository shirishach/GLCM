<?php

    include('glcmGenerator.php');

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
         $matrixString = $_POST['matrix'];
         $matrix = json_decode($matrixString,TRUE);
         $theta = $_POST['theta'];
         $distance = $_POST['distance'];
         $range = json_decode($_POST['range'],TRUE);

         $html = generateGLCM($matrix, $range, $distance, $theta);

        echo $html;
    }
    


?>