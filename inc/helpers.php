<?php 

// Workwear Builder Functions
function get_workwear_builder_items() {
    return isset($_SESSION['workwear_builder']) ? $_SESSION['workwear_builder'] : array();
}

function get_workwear_builder_count() {
    $items = get_workwear_builder_items();
    return count($items);
}