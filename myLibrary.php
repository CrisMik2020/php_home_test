<?php
function readFileCsv($file){
    $row = 1;
    if (($handle = fopen($file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $num = count($data); // count the number of columns in the csv file
            echo "<p> $num fields in line $row: <br /></p>\n";
            $row++;
            for ($c=0; $c < $num; $c++) {
                echo $data[$c] . "<br />\n"; // print the data in the csv file
            }
        }
        fclose($handle);
    }
}

?>