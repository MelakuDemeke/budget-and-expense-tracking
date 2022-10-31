<?php

declare(strict_types = 1);

// Your Code

function getTransactionFiles(string $filepath): array{
    $files = [];

    foreach(scandir($filepath) as $file){
        if(is_dir($file)){
            continue;
        }
        $files[] = $filepath . $file; 
    }
    return $files;
}

function getTransactions(string $fileName) : array {
    if(! file_exists($fileName)){
        trigger_error('FILE "'.$fileName.'" doest exits.',E_USER_ERROR);
    }

    $file = fopen($fileName,'r');
    $transactions = [];
    fgetcsv($file);
    
    while(($transacton = fgetcsv($file)) !== false){
        $transactions[] = $transacton;
    }
    return $transactions;
}