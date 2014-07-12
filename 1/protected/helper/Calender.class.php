<?php

class Render{
	
	function show($d){
		return $d['day'];
	}
}

class Calendar
{
    var $year;
    var $month;
    var $render;
    
    var $weeks  = array('星期日','星期一','星期二','星期三','星期四','星期五','星期六');
    
    var $weeks2  = array('日','一','二','三','四','五','六');
    
    
    function __construct($options = array()) {
        
        $vars = get_class_vars(get_class($this));
        foreach ($options as $key=>$value) {
            if (array_key_exists($key, $vars)) {
                $this->$key = $value;
            }
        }
    }
    
    function display($render=null)
    {
    	$render = $render ? $render : $this->render;
    	if(!$render) $render = new Render();
    	
        echo '<table class="calendar">';
        $this->showWeeks();
        $this->showDays($this->year,$this->month, $render);
        echo '</table>';
    }
    
    function nextMonth(){
    	$firstDay = mktime(0, 0, 0, $this->month, 1, $this->year);
    	//$starDay = date('w', $firstDay);
    	$days = date('t', $firstDay);
    	
    	return date("Y-m", $firstDay + $days * 24 * 60 * 60);
    }
    
    function preMonth(){
    	$firstDay = mktime(0, 0, 0, $this->month, 1, $this->year);
    	//$starDay = date('w', $firstDay);
    	//$days = date('t', $firstDay);

    	return date("Y-m", $firstDay - 24 * 60 * 60);    	 
    }
    
    
    
    
    private function showWeeks()
    {
        echo '<tr>';
        foreach($this->weeks as $title)
        {
            echo '<th>'.$title.'</th>';
        }
        echo '</tr>';
    }
    
    private function showDays($year, $month, $render)
    {
        $firstDay = mktime(0, 0, 0, $month, 1, $year);
        $starDay = date('w', $firstDay);
        $days = date('t', $firstDay);
        echo '<tr>';
        for ($i=0; $i<$starDay; $i++) {
            echo '<td>&nbsp;</td>';
        }
        
        for ($j=1; $j<=$days; $j++) {
            $i++;
            $d = array('date' => "{$this->year}-{$this->month}-" . sprintf("%02d", $j), 
            'day' => $j, 
            'n_date'=>sprintf("%04d%02d%02d", $this->year, $this->month, $j)
            );
            
            if ($j == date('d')) {
                echo '<td class="today">'. $render->show($d) .'</td>';
            } else {
                echo '<td>'. $render->show($d) .'</td>';
            }
            if ($i % 7 == 0) {
                echo '</tr><tr>';
            }
        }
        
        echo '</tr>';
    }
    
 
    
 
    
}

?>