<?php
/*
 |--------------------------------------------------------------------------
 | ??? for now.
 |--------------------------------------------------------------------------
 |
 |
 |
 |
 |
 |
 */
define('TRESO_CA_CATEG_ID', 7);
define('TRESO_EX_CATEG_ID', 8);
define('TRESO_CH1_CATEG_ID', 5);
define('TRESO_CH2_CATEG_ID', 6);


/*
 |--------------------------------------------------------------------------
 | Assets folders.
 |--------------------------------------------------------------------------
 |
 |
 |
 |
 |
 |
 */
define('CSS_FOLDER', 'assets/paydate/css/');
define('JS_FOLDER', 'assets/paydate/js/');
define('IMG_FOLDER', 'assets/paydate/img/');
define('EXTERNAL_ASSETS_FOLDER', 'assets/external/');


/*
 |--------------------------------------------------------------------------
 | Months of year in text version.
 |--------------------------------------------------------------------------
 |
 |
 |
 |
 |
 |
 */

// Full text.
//-----------
$config['monthsText'] = array (
	1	=> 'cal_january',
	2	=> 'cal_february',
	3	=> 'cal_march',
	4	=> 'cal_april',
	5	=> 'cal_mayl',
	6	=> 'cal_june',
	7	=> 'cal_july',
	8	=> 'cal_august',
	9	=> 'cal_september',
	10	=> 'cal_october',
	11	=> 'cal_november',
	12	=> 'cal_december'
);

// Only the first three letters.
//------------------------------
$config['monthsTextShort'] = array (
	1	=> 'cal_jan',
	2	=> 'cal_feb',
	3	=> 'cal_mar',
	4	=> 'cal_apr',
	5	=> 'cal_may',
	6	=> 'cal_jun',
	7	=> 'cal_jul',
	8	=> 'cal_aug',
	9	=> 'cal_sep',
	10	=> 'cal_oct',
	11	=> 'cal_nov',
	12	=> 'cal_dec'
);


/*
 |--------------------------------------------------------------------------
 | Days of the week in text version.
 |--------------------------------------------------------------------------
 |
 |
 |
 |
 |
 |
 */

// Full text.
//-----------
$config['daysText'] = array (
	1	=> 'cal_monday',
	2	=> 'cal_tuesday',
	3	=> 'cal_wednesday',
	4	=> 'cal_thursday',
	5	=> 'cal_friday',
	6	=> 'cal_saturday',
	7	=> 'cal_sunday'
);
