<?php

namespace Softbd\MenuBuilder\Controllers;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Softbd\MenuBuilder\Models\Menu;
use Softbd\MenuBuilder\Models\MenuItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class MenuBuilderController
{
    private const VIEW_PATH = 'menu-builder::';

    public function index(): View
    {
        $menus = Menu::all();

        return view(self::VIEW_PATH . 'browse', compact('menus'));
    }

    public function create(): View
    {
        $menu = new Menu();

        return view(self::VIEW_PATH . 'edit-add', compact('menu'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validator($request)->validate();

        $data = $request->all();

        try {
            Menu::create($data);
        } catch (\Throwable $exception) {
            Log::debug($exception->getMessage());
            return back()->with([
                'message' => __('Something went wrong. Please try again.'),
                'alert-type' => 'error'
            ]);
        }

        return back()->with([
            'message' => __('Menu created successfully.'),
            'alert-type' => 'success'
        ]);
    }

    public function show(int $id): View
    {
        $menu = Menu::findOrFail($id);

        return view(self::VIEW_PATH . 'read', compact('menu'));
    }

    public function edit(int $id): View
    {
        $menu = Menu::findOrFail($id);

        return view(self::VIEW_PATH . 'edit-add', compact('menu'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $menu = Menu::findOrFail($id);

        $this->validator($request)->validate();

        $data = $request->all();

        try {
            $menu->update($data);
        } catch (\Throwable $exception) {
            Log::debug($exception->getMessage());
            return back()->with([
                'message' => __('Something went wrong. Please try again.'),
                'alert-type' => 'error'
            ]);
        }

        return back()->with([
            'message' => __('Menu updated successfully.'),
            'alert-type' => 'success'
        ]);
    }

    public function destroy(int $id): RedirectResponse
    {
        $menu = Menu::findOrFail($id);
        try {
            $menu->delete();
        } catch (\Throwable $exception) {
            Log::debug($exception->getMessage());
            return back()->with([
                'message' => __('Something went wrong. Please try again.'),
                'alert-type' => 'error'
            ]);
        }

        return back()->with([
            'message' => __('Menu deleted successfully.'),
            'alert-type' => 'success'
        ]);
    }

    public function validator(Request $request): Validator
    {
        return \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|max:191'
        ]);
    }

    public function builder($id)
    {
        $menu = Menu::findOrFail($id);

        return view('menu-builder::menu-builder', compact('menu'));
    }

    public function delete_menu($menu_id, $id)
    {
        /** @var MenuItem $item */
        $item = MenuItem::findOrFail($id);

        $item->destroy($id);

        return redirect()
            ->route('menu-builder.menus.builder', $menu_id)
            ->with([
                'message' => __('Menu item deleted successfully'),
                'alert-type' => 'success',
            ]);
    }

    public function add_item(Request $request)
    {
        $data = $this->prepareParameters(
            $request->all()
        );

        unset($data['id']);
        $data['order'] = (new \Softbd\MenuBuilder\Models\MenuItem)->highestOrderMenuItem();

        /** @var MenuItem $menuItem */
        $menuItem = MenuItem::create($data);

        return redirect()
            ->route('menu-builder.menus.builder', $data['menu_id'])
            ->with([
                'message' => __('Menu item created successfully.'),
                'alert-type' => 'success',
            ]);
    }

    public function update_item(Request $request)
    {
        $id = $request->input('id');
        $data = $this->prepareParameters(
            $request->except(['id'])
        );

        /** @var MenuItem $menuItem */
        $menuItem = MenuItem::findOrFail($id);

        $menuItem->update($data);

        return redirect()
            ->route('menu-builder.menus.builder', $menuItem->menu_id)
            ->with([
                'message' => __('Menu item updated successfully.'),
                'alert-type' => 'success',
            ]);
    }

    public function order_item(Request $request)
    {
        $menuItemOrder = json_decode($request->input('order'));

        $this->orderMenu($menuItemOrder, null);
    }

    private function orderMenu(array $menuItems, $parentId)
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

    protected function prepareParameters($parameters)
    {
        switch (Arr::get($parameters, 'type')) {
            case 'route':
                $parameters['url'] = null;
                break;
            default:
                $parameters['route'] = null;
                $parameters['parameters'] = '';
                break;
        }

        if (isset($parameters['type'])) {
            unset($parameters['type']);
        }

        return $parameters;
    }
}
