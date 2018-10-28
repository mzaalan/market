<?php

if ( ! function_exists('uniq_name()')) {
    /**
     * @return string
     */
    function uniq_name()
    {      
        return sha1(microtime().rand(0,100));
    }
}
