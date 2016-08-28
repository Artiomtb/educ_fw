<?php
/**
 * Index controller
 *
 * PHP version 5.6
 *
 * @category   Controller
 * @package    Controller
 * @author     Artem Siliuk <asiliuk@mindk.com>
 * @copyright  2011-2016 mindk (http://mindk.com). All rights reserved.
 * @license    http://mindk.com Commercial
 * @link       http://mindk.com
 */

namespace App\Controller;

/**
 * Index controller
 *
 * @category   Controller
 * @package    Controller
 * @author     Artem Siliuk <asiliuk@mindk.com>
 * @copyright  2011-2016 mindk (http://mindk.com). All rights reserved.
 * @license    http://mindk.com Commercial
 * @link       http://mindk.com
 */
class IndexController
{
    
    public function index()
    {
        return 'index';
    }

    public function hello($name, $times)
    {
        $result = '';
        for ($i = 0; $i < (int)$times; $i++) {
            $result .= 'Hello, ' . $name . '!<br>';
        }
        return $result;
    }
}