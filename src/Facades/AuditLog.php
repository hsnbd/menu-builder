<?php
namespace Softbd\MenuBuilder\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Logger
 * @package MenuBuilder\Facades
 */
class MenuBuilder extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'menu-builder';
    }
}
