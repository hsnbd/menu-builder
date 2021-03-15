<?php

namespace Softbd\MenuBuilder\Controllers;

use Illuminate\Http\Request;
use Softbd\MenuBuilder\Repositories\MenuBuilderRepository;
use Softbd\MenuBuilder\Repositories\MenuRepository;

class MenuBuilderController
{
    private const VIEW_PATH = 'menu-builder::';

    private $menuBuilderRepo;

    public function __construct()
    {
        $this->menuBuilderRepo = new MenuBuilderRepository();
    }

    public function builder($id)
    {
        $menu = (new MenuRepository())->getMenuInstance($id);
        return view(self::VIEW_PATH.'menu-builder', compact('menu'));
    }

    public function orderItem(Request $request)
    {
        $menuItemOrder = json_decode($request->input('order'));

        $this->menuBuilderRepo->orderMenu($menuItemOrder, null);
    }
}
