<?php


if (!function_exists('get_formatted_date')) {
    function get_formatted_date($date)
    {
        $formattedDate = date_create($date);
        return date_format($formattedDate, "j-n-Y H:i");
    }
}

if (!function_exists('generateOrderNumber')) {
    function generateOrderNumber() {
        $orderNumber = mt_rand(1000000000000, 9999999999999); // better than rand()

        // call the same function if the barcode exists already
        if (orderNumberExists($orderNumber)) {
            return generateOrderNumber();
        }

        // otherwise, it's valid and can be used
        return $orderNumber;
    }
}

if (!function_exists('orderNumberExists')) {
    function orderNumberExists($number) {
        return \App\Models\Balance::whereOrderNo($number)->exists();
    }
}

