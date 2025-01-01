<?php
//https://phppot.com/php/how-to-get-the-client-user-ip-address-in-php/

function get_ip_address()
{
    $ip_address = '';
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
	{
        $ip_address = $_SERVER['HTTP_CLIENT_IP']; // Get the shared IP Address
    }
	else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	{
        //Check if the proxy is used for IP/IPs
        // Split if multiple IP addresses exist and get the last IP address
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false)
		{
            $multiple_ips = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);
            $ip_address = trim(end($multiple_ips));
        }
		else
		{
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
	else if(!empty($_SERVER['HTTP_X_FORWARDED']))
	{
        $ip_address = $_SERVER['HTTP_X_FORWARDED'];
    }
	else if(!empty($_SERVER['HTTP_FORWARDED_FOR']))
	{
        $ip_address = $_SERVER['HTTP_FORWARDED_FOR'];
    }
	else if(!empty($_SERVER['HTTP_FORWARDED']))
	{
        $ip_address = $_SERVER['HTTP_FORWARDED'];
    }
	else
	{
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }
    return $ip_address;
}
	
function validate_ip($ip_address)
{
    if (filter_var($ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | 
        FILTER_FLAG_IPV6 | FILTER_FLAG_NO_PRIV_RANGE |
        FILTER_FLAG_NO_RES_RANGE) === false) {
        return false;
    }
    return true;
}	