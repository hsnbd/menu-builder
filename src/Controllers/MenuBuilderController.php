<?php

namespace Softbd\MenuBuilder\Controllers;


class MenuBuilderController
{
    public function index()
    {
        $menu = new \stdClass();
        $menu->name = 'Admin Menu';
        $menu->code = 'AM';

        $menu2 = new \stdClass();
        $menu2->name = 'Admin Menu 2';
        $menu2->code = 'AM2';

        $menus = [
            $menu,
            $menu2
        ];

        return view('menu-builder::browse', compact('menus'));
    }

    public function menuBuilder()
    {
        $menu = new \stdClass();
        $menu->name = 'Admin Menu';
        $menu->code = 'AM';

        $menu2 = new \stdClass();
        $menu2->name = 'Admin Menu 2';
        $menu2->code = 'AM2';

        $menus = [
            $menu,
            $menu2
        ];

        return view('menu-builder::menu-builder', compact('menus'));
    }
}
