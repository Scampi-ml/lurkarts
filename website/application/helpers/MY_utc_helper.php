<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
if ( ! function_exists('utc'))
{
    function utc($utc_time)
	{
		//$dateString = "2024-02-01T19:47:30.26Z";

		// Create a DateTime object from the provided string
		$dateTime = new DateTime($utc_time);

		// Set the timezone to Brussels
		$brusselsTimezone = new DateTimeZone('Europe/Brussels');
		$dateTime->setTimezone($brusselsTimezone);

		// Convert to the desired format
		$formattedDateTime = $dateTime->format('d/m/y - H:i');
		//$formattedDateTime = $dateTime->format('d/m/y - H:i');

		// Output the formatted date and time
		return $formattedDateTime; // Output: 01-02-24 20:47 (assuming Brussels timezone is UTC+1)
    }
}

*/


//Zone Type 1: Offset
//$d = new DateTime('2011-09-13 14:15:16 -0400');

// https://stackoverflow.com/questions/15625834/how-to-convert-between-time-zones-in-php-using-the-datetime-class

if ( ! function_exists('utc'))
{
    function utc($utc_time)
	{
		
		$original_datetime = $utc_time;
		
		//$original_datetime = '04/01/2013 03:08 PM';
		$original_timezone = new DateTimeZone('UTC');

		// Instantiate the DateTime object, setting it's date, time and time zone.
		$datetime = new DateTime($original_datetime, $original_timezone);

		// Set the DateTime object's time zone to convert the time appropriately.
		$target_timezone = new DateTimeZone('Europe/Brussels');
		$datetime->setTimeZone($target_timezone);

		// Outputs a date/time string based on the time zone you've set on the object.
		$triggerOn = $datetime->format('d/m/y - H:i');

		// Print the date/time string.
		return $triggerOn; // 2013-04-01 08:08:00

    }
}


