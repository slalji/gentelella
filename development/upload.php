<?php
$fileName="2018-03-21_SMPOS_LEDGER (1).csv";
$tableName ="transactions";
$query = <<<eof
    LOAD DATA INFILE '$fileName'
     INTO TABLE '$tableName'
     FIELDS TERMINATED BY '|' OPTIONALLY ENCLOSED BY '"'
     LINES TERMINATED BY '\n'
    (
        fulltimestamp
        vendor
        type
        transid
        reference
        utility_code
        utility_reference
        amount
        discounted
        COL11
        COL12)
eof;

$db->query($query);
?>