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
     * @param array $config
     */
    public function __construct($config = [])
    {
        $this->config = $config;
    }

    /**
     * Application exec
     */
    public function run()
    {
        $router = new Router(isset($this->config['routes']) ? $this->config['routes'] : []);
        $route = $router->getRoute();
        if (!$route) {
            //todo throw 404
        } else {
            //todo call controller, get response and render
            echo call_user_func_array('App\\Controller\\' . $route['class'] . '::' . $route['method'], $route['variables']);
        }
    }


    public function done()
    {

    }
}