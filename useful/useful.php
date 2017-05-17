<?php

/* Useful PHP Functions ===================================================== */

/*
 * Sorts 2-Dimensional Array by a specified Field.
 * 
 * While 'array_multisort' sorts only by the first Field, we must create a 
 * "Ruler" to use another Field, and give this "Ruler" to 'array_multisort'.
 * 
 * @param array $array Array to be sorted
 * @param string $field Field in the associative Array to be used for Sorting
 * @param integer $sort_order Sort Order
 * @param integer $sort_flags Sort Flags
 * @return bool Successful Sorting Status
 */

function sort_assoc_2d (&$array, $field, $sort_order, $sort_flags) : bool
{  
    $ruler = array();
    foreach ($array as $key => $sub_array)
    {
        $ruler[$key] = $sub_array[$field];
    }
    
    $result = array_multisort($ruler, $sort_order, $sort_flags, $array);
    return $result;
}

/* Usage */

$sizes = 
[
    ["Length" => 10, "Width" => 20, "Height" => 30],
    ["Length" => 15, "Width" => 18, "Height" => 16], 
    ["Length" => 13, "Width" => 24, "Height" => 9]
];
var_dump($sizes);
print("<br>\r\n<br>\r\n");

sort_assoc_2d($sizes, "Height", SORT_ASC, SORT_NUMERIC);
var_dump($sizes);
print("<br>\r\n<br>\r\n");

?>
