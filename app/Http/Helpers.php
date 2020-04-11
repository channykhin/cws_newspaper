<?php
class Helpers {
    public static function number_en(){
        $number = array('0','1','2','3','4','5','6','7','8','9');
        return $number;
    }
    public static function number_kh(){
        $number = array('០','១','២','៣','៤','៥','៦','៧','៨','៩');
        return $number;
    }
    public static function time_en(){
        $time_en = array(
//          Second
            'second ago','seconds ago','minute ago','minutes ago','hour ago','hours ago','day ago','days ago','week ago','weeks ago','month ago','months ago','year ago','years ago');
        return $time_en;
    }
    public static function time_kh(){
        $time_kh = array('វិនាទីមុន','វិនាទីមុន','នាទីមុន','នាទីមុន','ម៉ោងមុន','ម៉ោងមុន','ថ្ងៃមុន','ថ្ងៃមុន','សប្ដាហ៍មុន','សប្ដាហ៍មុន','ខែមុន','ខែមុន','ឆ្នាំមុន','ឆ្នាំមុន');
        return $time_kh;
    }
}
    