<?php

class EncryptionManager
{
    public $first_array = [];
    public $second_array = [];
    public function __construct($first_array, $second_array)
    {
        $this->first_array = $first_array;
        $this->second_array = $second_array;
    }

    public function get_corelation(){
        $n = 26;
        $multipled_x_y_array = [];
        foreach ($this->second_array as $key => $second_array_element){
            $multipled_x_y_array[] = $second_array_element * $this->first_array[$key];
        }
        $sum_multiplication_array = round(array_sum($multipled_x_y_array),1);
        $sum_x = round(array_sum($this->first_array),1);
        $sum_y = round(array_sum($this->second_array),1);
        $powered_x = array_map(function ($value) {return $value ** 2;}, $this->first_array);
        $sum_powered_x = round(array_sum($powered_x),1);
        $power_sum_x = $sum_x ** 2;
        $powered_y = array_map(function ($value) {return $value ** 2;}, $this->second_array);
        $sum_powered_y = round(array_sum($powered_y),1);
        $power_sum_y = $sum_y ** 2;
        $corelation_coefficient = ($n * $sum_multiplication_array - $sum_x * $sum_y) / (sqrt($n * $sum_powered_x - $power_sum_x) * sqrt($n * $sum_powered_y - $power_sum_y));
        return $corelation_coefficient;
    }

    public function get_key(){
        $index = 0;
        $corelation_values = [];
        while ($index < 26){
            $corelation_values[] = $this->get_corelation();
            $array_percentege = array_shift($this->second_array);
            $this->second_array[] = $array_percentege;
            $index ++;
        }

        return array_search(max($corelation_values), $corelation_values);
    }

}