<?php  
foreach (glob("www-static/storage/*/information*") as $filename) {
    echo "$filename size " . filesize($filename) . "<br/>";
    chown($filename,'networks');
    chgrp($filename,'networks');
    unlink($filename);
}

?>