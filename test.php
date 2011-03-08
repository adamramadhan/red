<?php  
foreach (glob("www-static/storage/*/information*") as $filename) {
    echo "$filename size " . filesize($filename) . "<br/>";
    chmod($filename,0777);
    chown($filename,'networks');
    chgrp($filename,'networks');
    unlink($filename);
}

?>