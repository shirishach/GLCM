<?php

    /* Function to generate GLCM Matrix on basis of recieved
        image matrix anf parameters */
    function generateGLCM($matrix, $range, $distance, $theta)
    {
         $rowElemNum; $colElemNum;
         $totalElements = $range[1] - $range[0]+1;
         $glcm[$totalElements][$totalElements];

         $html = "<table id='glcm'>";

        for($rowCnt=0;$rowCnt<$totalElements;$rowCnt++)
        {
            $html.="<tr>";

            for($colCnt=0;$colCnt<$totalElements;$colCnt++)
            {
                $count = getMatchingPairs($matrix, $rowCnt+1, $colCnt+1, $distance, $theta);

                $html.= $count;
            }
            $html.="</tr>";
        }

         $html .= "</table>";

        return $html;

    }

    /* Function to fetch matching pairs of the image matrix elements
        Search for 1 pair at a time. Provides html code with pair location
        embedded as ID */
    function getMatchingPairs($matrix, $rowElem, $colElem, $distance, $theta)
    {  
        $count=0;
        $pairs="";

        $totalRows=count($matrix);
        $totalCols=count($matrix[1]);

        for($rows=0;$rows<$totalRows;$rows++)
        {
            
            for($cols=0;$cols<$totalCols-$distance;$cols++)
            {
                if($theta == 0)
                {
                    if(($matrix[$rows][$cols] == $rowElem) && ($matrix[$rows][$cols + $distance] == $colElem) || 
                    ($matrix[$rows][$cols] == $colElem) && ($matrix[$rows][$cols + $distance] == $rowElem))
                    {
                        $count = $count + 1;
                        $pairs.=($rows*$totalCols) + ($cols+1). "-". ($rows*$totalCols) + ($cols+1+$distance)."+";
                    }
                }
                else if($theta == 90)
                {
                    if(($matrix[$rows][$cols] == $rowElem) && ($matrix[$rows + $distance][$cols] == $colElem) || 
                    ($matrix[$rows][$cols] == $colElem) && ($matrix[$rows + $distance][$cols] == $rowElem))
                    {
                        $count = $count + 1;
                        $pairs.=($rows*$totalCols) + ($cols+1). "-". ($rows + $distance)*$totalCols + ($cols+1)."+";
                    }
                }
                else if($theta == 45)
                {
                    if(($matrix[$rows][$cols] == $rowElem) && ($matrix[$rows - $distance][$cols + $distance] == $colElem) || 
                    ($matrix[$rows][$cols] == $colElem) && ($matrix[$rows - $distance][$cols + $distance] == $rowElem))
                    {
                        $count = $count + 1;
                        $pairs.=($rows*$totalCols) + ($cols+1). "-". ($rows - $distance)*$totalCols + ($cols+1 + $distance)."+";
                    }
                }
                else if($theta == 135)
                {
                    if(($matrix[$rows][$cols] == $rowElem) && ($matrix[$rows - $distance][$cols - $distance] == $colElem) || 
                    ($matrix[$rows][$cols] == $colElem) && ($matrix[$rows - $distance][$cols - $distance] == $rowElem))
                    {
                        $count = $count + 1;
                        $pairs.=($rows*$totalCols) + ($cols+1). "-". ($rows - $distance)*$totalCols + ($cols+1 - $distance)."+";
                    }
                }
            }
        }

        $code = "<td id='".$pairs."' onclick='highlightPairs(event)' >".$count."</td>";

        return $code;
    }

?>