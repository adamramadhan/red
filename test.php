<?php  
foreach (glob("www-static/storage/*/information*") as $filename) {
    echo "$filename size " . filesize($filename) . "<br/>";
    unlink($filename);
}
?>