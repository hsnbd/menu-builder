<?php

namespace Softbd\MenuBuilder\Repositories;

use Illuminate\Database\Eloquent\Model;
use Softbd\MenuBuilder\Models\Menu;
use Softbd\MenuBuilder\Models\MenuItem;

class MenuBuilderRepository
{
    public function orderMenu(array $menuItems, $parentId)
    {
        foreach ($menuItems as $index => $menuItem) {
            /** @var Model $item */
            $item = MenuItem::findOrFail($menuItem->id);
            $item->order = $index + 1;
            $item->parent_id = $parentId;
            $item->save();

            if (isset($menuItem->children)) {
                $this->orderMenu($menuItem->children, $item->id);
            }
        }
    }

    /**
     * @param string $exportFileType
     * @return bool
     */
    public function exportMenu(string $exportFileType): bool
    {
        $menu = Menu::all()->toArray();

//        Storage::putFileAs();
    }

    /**
     * @param string $importFileType
     * @return string
     */
    public function importMenu(string $importFileType): string
    {

    }
}
