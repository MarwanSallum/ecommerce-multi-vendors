<?php

function getCssFolder(){
    return app() -> getLocale() == 'ar' ? 'css-rtl' : 'css';
}

function uploadImage($folder, $image){
    $image -> store('/', $folder);
    $filename = $image -> hashName();
    $path = 'images/' . $folder . '/' . $filename;
    return $path;
}