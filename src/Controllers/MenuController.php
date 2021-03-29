<?php


namespace Hsnbd\MenuBuilder\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Hsnbd\MenuBuilder\Models\Menu;
use Hsnbd\MenuBuilder\Repositories\MenuRepository;

class MenuController
{
    private const VIEW_PATH = 'menu-builder::menus.';
    private $menuRepo;

    public function __construct()
    {
        $this->menuRepo = new MenuRepository();
    }

    public function index(): View
    {
        $menus = $this->menuRepo->getAllMenu();
        return view(self::VIEW_PATH . 'browse', compact('menus'));
    }

    public function create(): View
    {
        $menu = new Menu();

        return view(self::VIEW_PATH . 'edit-add', compact('menu'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->menuRepo->validator($request)->validate();

        $data = $request->all();

        try {
            $this->menuRepo->createMenu($data);
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

    public function edit(int $id): View
    {
        $menu = $this->menuRepo->getMenuInstance($id);

        return view(self::VIEW_PATH . 'edit-add', compact('menu'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $menu = $this->menuRepo->getMenuInstance($id);

        $this->menuRepo->validator($request)->validate();

        $data = $request->all();

        try {
            $this->menuRepo->updateMenu($menu, $data);
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
        $menu = $this->menuRepo->getMenuInstance($id);

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
}
