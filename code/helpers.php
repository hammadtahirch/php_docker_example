<?php
function baseUrl($url){
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    if($url === ''){
        return $host.$uri;
    }else{
        return $host.$uri.'/'.$url;
    }

}
?>
