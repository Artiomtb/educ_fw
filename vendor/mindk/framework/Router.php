<?php
/**
 * Router class
 *
 * PHP version 5.6
 *
 * @category   Router
 * @package    Framework
 * @author     Artem Siliuk <asiliuk@mindk.com>
 * @copyright  2011-2016 mindk (http://mindk.com). All rights reserved.
 * @license    http://mindk.com Commercial
 * @link       http://mindk.com
 */


namespace Framework;

/**
 * Router class
 *
 * @category   Router
 * @package    Framework
 * @author     Artem Siliuk <asiliuk@mindk.com>
 * @copyright  2011-2016 mindk (http://mindk.com). All rights reserved.
 * @license    http://mindk.com Commercial
 * @link       http://mindk.com
 */
class Router
{
    private $routes = [];

    /**
     * Router constructor.
     * @param $routes_config
     */
    public function __construct($routes_config)
    {
        $parsed_routes_config = [];

        foreach ($routes_config as $route_key => $route_config) {
            $parsed_routes_config[$route_key] = [
                'key' => $route_key,
                'pattern' => $route_config['pattern'],
                'regexp' => $this->preProcessPattern($route_config),
                'http_method' => isset($route_config['method']) ? $route_config['method'] : 'GET',
                'class' => $this->getClassFromConfig($route_config),
                'method' => $this->getMethodFromConfig($route_config),
                'variables' => isset($route_config['variables']) ? array_keys($route_config['variables']) : null
            ];
        }

        $this->routes = $parsed_routes_config;
    }

    public function getRoute()
    {
        //todo replace getting from Request class
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if (!$this->checkMethod($method, $route)) {
                continue;
            }

            $route_check = $this->checkAndGetVariables($uri, $route);
            if ($route_check === true) {
                return $this->formatAnswer($route);
            } elseif (is_array($route_check)) {
                return $this->formatAnswer($route, $route_check);
            }
        }

        return null;
    }

    /**
     * Returns URI by route key and variables
     *
     * @param string $route_key
     * @param array $variables associative array with variables
     *
     * @return string URI
     */
    public function getURI($route_key, $variables = [])
    {
        $route = $this->routes[$route_key]['pattern'];
        foreach ($variables as $var_name => $var_value) {
            $route = str_replace('{' . $var_name . '}', $var_value, $route);
        }

        return $route;
    }

    /**
     * Makes regexp pattern from uri pattern.
     * Replaces variables to regular expressions. Escapes slashes and adds start and end symbols.
     *
     * @param array $route_config
     * @return string regexp
     */
    private function preProcessPattern($route_config)
    {
        $pattern = $route_config['pattern'];
        $variables = $route_config['variables'];
        $result = str_replace('/', '\/', $pattern);

        //get variables from pattern
        preg_match_all("/{.+}/U", $pattern, $output_array);
        foreach ($output_array[0] as $variable) {
            $variable_name = substr($variable, 1, strlen($variable) - 2);
            $result = str_replace(
                $variable,
                '(' . (isset($variables[$variable_name]) ? $variables[$variable_name] : '[^\/]+') . ')',
                $result
            );
        }

        return '/^' . $result . '$/';
    }

    /**
     * Returns class name (with namespace) from route config
     *
     * @param array $route_config
     * @return string class name
     */
    private function getClassFromConfig($route_config)
    {
        $action = $route_config['action'];
        return substr($action, 0, strpos($action, '@'));
    }

    /**
     * Returns method name from route config
     *
     * @param array $route_config
     * @return string method name
     */
    private function getMethodFromConfig($route_config)
    {
        $action = $route_config['action'];
        return substr($action, strpos($action, '@') + 1);
    }

    /**
     * Returns if route HTTP method matches current
     *
     * @param string $method HTTP method as string
     * @param array $route route config
     * @return bool
     */
    private function checkMethod($method, $route)
    {
        return $method === $route['http_method'];
    }

    /**
     * Checks if URI matches specified route config.
     * Returns false if uri does not matches route, true or variables array if matches.
     *
     * @param string $uri
     * @param array $route route config
     * @return array|bool
     */
    private function checkAndGetVariables($uri, $route)
    {
        preg_match($route['regexp'], $uri, $output);

        $regexp_res_count = count($output);
        if ($regexp_res_count > 0) {
            if ($regexp_res_count > 1) {
                return array_slice($output, 1);
            }
            return true;
        }

        return false;
    }

    /**
     * Returns router search result as array
     *
     * @param array $route matched route config
     * @param array $variables variables value array
     * @return array route params
     */
    private function formatAnswer($route, $variables = [])
    {
        $variables_map = [];
        for ($i = 0; $i < count($variables); $i++) {
            $variables_map[$route['variables'][$i]] = $variables[$i];
        }

        return [
            'key' => $route['key'],
            'class' => $route['class'],
            'method' => $route['method'],
            'variables' => $variables_map
        ];
    }
}