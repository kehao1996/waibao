<?php


p($_FILES);

/*
 *print_r 数据数组
*/
function p($data)
{
    echo "<pre style='padding: 15px;background: #ccc;border-radius: 6px'>";
    if (is_null($data)) {
        var_dump($data);
    } elseif (is_bool($data)) {
        var_dump($data);
    } else {
        print_r($data);
    }
    echo '</pre>';
}