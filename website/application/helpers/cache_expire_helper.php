<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// https://stackoverflow.com/questions/16335569/deleting-database-cache-after-some-time-codeigniter
define("CACHE_DIR", APPPATH.'cache/');

if ( ! function_exists('is_cache_valid'))
{
    function is_cache_valid($cache_name,$lifespan)
	{
        if (file_exists(CACHE_DIR.$cache_name))
		{
            $last_date = file_get_contents(CACHE_DIR.$cache_name);
            if (abs($last_date - time()) < $lifespan)
			{
                return true;
            }
			else
			{
                file_put_contents(CACHE_DIR.$cache_name,time());
                return false;
            }
        }
		else
		{
            file_put_contents(CACHE_DIR.$cache_name,time());
            return true;
        }
    }
}