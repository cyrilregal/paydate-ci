<?php

/**
 * Convert decimal separator from "," to "."
 * @param float $number
 * @return string
 */
function commaToDot($number) {
	return strtr($number, ',' , '.');
}

/**
 * Convert decimal separator from "." to ","
 * @param float $number
 * @return string
 */
function dotToComma($number) {
	return strtr($number, '.' , ',');
}

/**
 * Format price in French notation for display.
 * @param float $price
 * @return string
 */
function englishToFrenchPrice($price){
	return number_format($price, 2, ',', ' ');
}

/**
 * Format price in English notation (without thousand separator) for database records.
 * @param float $price
 * @return string
 */
function frenchToEnglishPrice($price){
	return number_format($number, 2, '.', '');
}