<?php
/**
 * Api controller
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
 * Api controller
 *
 * @category   Controller
 * @package    Controller
 * @author     Artem Siliuk <asiliuk@mindk.com>
 * @copyright  2011-2016 mindk (http://mindk.com). All rights reserved.
 * @license    http://mindk.com Commercial
 * @link       http://mindk.com
 */
class ApiController
{

    public function getAll()
    {
        return json_encode([
            'success' => true,
            'data' => [
                ['id' => 1, 'name' => 'Item-1'],
                ['id' => 2, 'name' => 'Item-2'],
                ['id' => 3, 'name' => 'Item-3']
            ]
        ]);
    }

    public function getItem($id)
    {
        return json_encode([
            'success' => true,
            'data' => [
                'id' => $id,
                'name' => 'Item-' . $id
            ]
        ]);
    }

    public function createItem()
    {

    }

    public function updateItem($id)
    {

    }
    
}