<?php

class PayrollExpense{

	private $year;
	private $payroll = array();
	private $expenses = array();

	function __construct($year){
		$this->year = $year;
	}

	public function calculatePayroll(){
		for($month = 1; $month <=12; $month++){
			for($day = cal_days_in_month(CAL_GREGORIAN, $month, $this->year); $day >= 1; $day--){
				$calc = jddayofweek ( cal_to_jd(CAL_GREGORIAN, $month, $day, $this->year) , 1 );
				if($calc == "Friday"){
					if($month < 10){
						array_push($this->payroll, "{$day}-0{$month}-{$this->year}");
						break;
					}
					else{
						array_push($this->payroll, "{$day}-{$month}-{$this->year}");
						break;
					}
				}
			}
		} 
		return $this->payroll;
	}

	public function calculateExpenses(){
		for($month = 1; $month <=12; $month++){
			$day = 15;
			$calc = jddayofweek ( cal_to_jd(CAL_GREGORIAN, $month, $day, $this->year) , 1 );
			if($calc == "Sunday"){
				$day = $day + 1;
				// $calc = jddayofweek ( cal_to_jd(CAL_GREGORIAN, $month, $day, $this->year) , 1 );
				// echo "{$day}-{$month}-{$this->year}: "."{$calc}"."<br>";
				if($month < 10){
					array_push($this->expenses, "{$day}-0{$month}-{$this->year}");
				}
				else{
					array_push($this->expenses, "{$day}-{$month}-{$this->year}");
				}
			}
			elseif ($calc == "Saturday") {
				$day = $day + 2;
				// $calc = jddayofweek ( cal_to_jd(CAL_GREGORIAN, $month, $day, $this->year) , 1 );
				// echo "{$day}-{$month}-{$this->year}: "."{$calc}"."<br>";
				if($month < 10){
					array_push($this->expenses, "{$day}-0{$month}-{$this->year}");
				}
				else{
					array_push($this->expenses, "{$day}-{$month}-{$this->year}");
				}
			}
			else{
				// echo "{$day}-{$month}-{$this->year}: "."{$calc}"."<br>";
				if($month < 10){
					array_push($this->expenses, "{$day}-0{$month}-{$this->year}");
				}
				else{
					array_push($this->expenses, "{$day}-{$month}-{$this->year}");
				}	
			}	
		} 
		return $this->expenses;
	}
}

?>