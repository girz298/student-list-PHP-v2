<?php

function each_true(array $arr, callable $callback){
    foreach ($arr as $key => $value) {
        if (!$callback($arr, $key, $value)) {
            return false;
        }
    }
    return true;
}