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
        $transactions[] = extractTransaction($transacton);
    }
    return $transactions;
}

function extractTransaction(array $transactionRow): array{
    [$date,$checkNumber,$description,$amount] = $transactionRow;

    $amount = (float)str_replace(['$',','],'',$amount);

    return [
        'date' => $date,
        'checkNumber' => $checkNumber,
        'description' => $description,
        'amount' => $amount,
    ];
}

function calculateTotals(array $transactions): array{
    $totals = ['netTotal' => 0, 'totalIncome' => 0, 'totalExpense' => 0];
    foreach($transactions as $transaction){
        $totals['netTotal'] += $transaction['amount'];
        
        if($transaction['amount'] >= 0){
            $totals['netIncome'] += $transaction['amount'];
        }else{
            $totals['totalExpense'] += $transaction['amount'];
        }
    }
    return $totals;
}