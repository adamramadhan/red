<?php  
foreach (glob("www-static/storage/*/*") as $filename) {
    echo "$filename size " . filesize($filename) . "<br/>";
    chmod($filename,0644);
    chown($filename,'networks');
    chgrp($filename,'networks');
}

?>