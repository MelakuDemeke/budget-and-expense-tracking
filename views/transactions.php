<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tranactions)): ?>
                    <?php foreach($tranactions as $tranaction): ?>
                        <tr>
                            <td><?= formatDate($tranaction['date']) ?></td>
                            <td><?= $tranaction['checkNumber']?></td>
                            <td><?= $tranaction['description'] ?></td>
                            <td>
                                <?php if($tranaction['amount'] < 0): ?>
                                    <span style="color:red">
                                        <?= formatDollarAmount($tranaction['amount']) ?>
                                    </span>
                                <?php elseif($tranaction['amount'] > 0): ?>
                                    <span style="color:green">
                                        <?= formatDollarAmount($tranaction['amount']) ?>
                                    </span>
                                <?php else: ?>
                                    <?= formatDollarAmount($tranaction['amount']) ?>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td><?= formatDollarAmount($totals['totalIncome']) ?? 0 ?></td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td><?= formatDollarAmount($totals['totalExpense']) ?? 0 ?></td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td><?= formatDollarAmount($totals['netTotal']) ?? 0 ?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
