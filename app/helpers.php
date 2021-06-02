<?php
    function get_random_str(int $len = 8, int $mix_mode = 6) {
        $num_arr = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
        $char_arr = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
        $special_arr = ["!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "-", "_", "+", "=", "{", "}", "[", "]", ":", ";", "<", ">", ".", "?", "/", "|", "~"];
        $tmp_arr = [];
        $random_str = "";

        switch ($mix_mode) {
            case 6: $tmp_arr = array_merge($num_arr, $char_arr); break;
            case 7: $tmp_arr = array_merge($num_arr, $char_arr, $special_arr); break;
            case 4: $tmp_arr = $num_arr; break;
            case 2: $tmp_arr = $char_arr; break;
            case 5: $tmp_arr = array_merge($num_arr, $special_arr); break;
            case 3: $tmp_arr = array_merge($char_arr, $special_arr); break;
            case 1: $tmp_arr = $special_arr;
            default: $tmp_arr = array_merge($num_arr, $char_arr, $special_arr); break;
        }

        shuffle($tmp_arr);
        $arr_max_len = count($tmp_arr) - 1;

        for ($i = 0; $i < $len; $i++) {
            $random_str .= $tmp_arr[mt_rand(0, $arr_max_len)];
        }

        return $random_str;
    }
?>
