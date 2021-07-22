<?php


use Controllers\LeadsController;

require __DIR__.'/./../vendor/autoload.php';
$start = microtime(true);
$leadsController = new LeadsController();
$leadsController->createLeads();
$finish = microtime(true);
$delta = $finish - $start;
echo $delta . ' сек.';
