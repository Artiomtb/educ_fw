<?php
/**
 * Created by PhpStorm.
 * User: dimmask
 * Date: 14.08.16
 * Time: 9:19
 */

namespace Framework;

/**
 * Class App
 * @package App
 */
class App
{
    public $config = [];

    /**
     * App constructor.
     */
    public function __construct($config = [])
    {
        $this->config = $config;
    }

    /**
     * Application exec
     */
    public function run(){

    }


    public function done(){

    }
}