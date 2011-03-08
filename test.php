<?php  
foreach (glob("www-static/storage/*/information*") as $filename) {
    unlink($filename);
}

?>