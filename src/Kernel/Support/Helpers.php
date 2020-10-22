<?php

//namespace GatherProduct\Kernel\Support;
use GuzzleHttp\Client;

if (!function_exists('array_to_json')){
    function array_to_json($arr){
        return json_encode($arr,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
    }
}

if (!function_exists('json_to_array')){
    function json_to_array($json){
        return  json_decode($json,true);
    }
}

function http(){
    return new Client();
}

