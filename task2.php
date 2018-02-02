<h1>Technical Test 2: Payroll and Expense Date</h1>
<?php

require ("PayrollExpense.php");

$year = 2018;
$obj = new PayrollExpense($year);
$resPayroll = $obj->calculatePayroll();
$resExpense = $obj->calculateExpenses();

echo "<b>Expense Date</b><br>";
foreach ($resExpense as $val) {
	echo "{$val}<br>";
}

echo "<br><b>Payroll Date</b><br>";
foreach ($resPayroll as $val) {
	echo "{$val}<br>";
}

?>