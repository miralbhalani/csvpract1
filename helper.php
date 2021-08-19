<?php

function CsvParse($file,$callback)
{

    $handle = fopen($file, "r");

    // Optionally, you can keep the number of the line where
    // the loop its currently iterating over
    $lineNumber = 1;

    // Iterate over every line of the file
    while (($raw_string = fgets($handle)) !== false) {
        // Parse the raw csv string: "1, a, b, c"
        $row = str_getcsv($raw_string);

        // into an array: ['1', 'a', 'b', 'c']
        // And do what you need to do with every line

        call_user_func_array($callback,array($row,$lineNumber));
            
        
        // Increase the current line
        $lineNumber++;
    }

    fclose($handle);

    return true;
}

function mapHeadings($headingMap, $sourceHeadingArray)
{
    $headingArray = [];
    foreach ($sourceHeadingArray as $value) {
        $headingArray[] = $headingMap[$value][0];
    }

    return $headingArray;
}

function createPositionMapper($sourceHeaderColumns, $headingMappings)
{
    $targetPositionCounter = 0;
    foreach ($sourceHeaderColumns as $value) {
        $targetPosition = $headingMappings[$value][1];
        $soursePosition = $targetPositionCounter;

        $positionMapper[$soursePosition] = $targetPosition;
        $targetPositionCounter++;
    }

    return $positionMapper;
}

function printpre($info)
{
    echo '<pre>',print_r($info,1),'</pre>';
}

?>