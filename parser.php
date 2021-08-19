<?php

include "helper.php";
include "CsvFileSaver.php";
include "settings.php";

$sourceFileName = $argv[1]; //|| "example_1.csv";
$targetFileName = $argv[2]; // || "combination_count.csv";

$contentSaver = new CsvFileSaver();
$groupedArray = [];
$columnIndexOfCountColumn = 7;
$positionMapper = [];


$success = CsvParse($sourceFileName,function($chunk,$rowNumber) use(&$groupedArray, $headingMappings, &$columnIndexOfCountColumn, &$positionMapper) {
    
    if($rowNumber == 1)
    {
        $positionMapper = createPositionMapper($chunk, $headingMappings);
        $chunk = mapHeadings($headingMappings, $chunk);
        $columnIndexOfCountColumn = count($chunk);
    }

    $keyVal = implode("-",$chunk);

    if(!isset($groupedArray[$keyVal]))
    {
        $groupedArray[$keyVal] = [];
        $chunkCounter = 0;
        foreach ($chunk as $value) {
            $groupedArray[$keyVal][$positionMapper[$chunkCounter]] = $chunk[$chunkCounter];
            $chunkCounter++;
        }
        if($rowNumber != 1)
        {
            $groupedArray[$keyVal][] = 1;
        }
        else 
        {
            $groupedArray[$keyVal][] = "count";
        }
    }
    else 
    {
        $groupedArray[$keyVal][$columnIndexOfCountColumn] = $groupedArray[$keyVal][$columnIndexOfCountColumn] + 1;
    }

});


$contentSaver->Save($targetFileName, $groupedArray);

?>