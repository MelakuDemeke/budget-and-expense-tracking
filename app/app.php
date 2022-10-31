<?php

declare(strict_types = 1);

// Your Code

function getTransactionFile(string $filepath): array{
    $files = [];

    foreach(scandir($filepath) as $file){
        if(is_dir($file)){
            continue;
        }
        $files[] = $filepath . $file; 
    }
    return $files;
}