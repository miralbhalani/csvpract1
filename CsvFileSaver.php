<?php

include "IContentSaver.php";

class CsvFileSaver implements IContentSaver
{
    public function Save($filePath, $contentArray) {
        if(file_exists($filePath))
        {
            unlink($filePath);
        }
        
        $f = fopen($filePath, 'w'); 

        foreach ($contentArray as $value) {
            fputcsv($f, $value);
        }

        fclose($f);
    }
}

?>

