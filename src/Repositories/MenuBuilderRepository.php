<?php

namespace Softbd\MenuBuilder\Repositories;


use Illuminate\Support\Facades\Storage;

class MenuBuilderRepository
{
    private const FILE_CONFIG_ALIAS = 'menu-builder-json-local';

    public function getMenuInstance(string $name)
    {
        $menu = new \stdClass();
        $menu->id = $name;
        $menu->name = $name;
        return $menu;
    }

    /**
     * @param string $menuName
     * @return bool
     */
    public function createMenuFile(string $menuName): bool
    {
        $menu = $this->processJsonFileName($menuName);

        return Storage::disk(self::FILE_CONFIG_ALIAS)->put($menu, '');
    }

    /**
     * @param string $oldMenuName
     * @param string $newMenuName
     * @return bool
     * @throws \Throwable
     */
    public function updateMenuFile(string $oldMenuName, string $newMenuName): bool
    {
        $oldMenuName = $this->addJsonExtension($oldMenuName);
        $oldMenu = Storage::disk(self::FILE_CONFIG_ALIAS)->get($oldMenuName);
        Storage::disk(self::FILE_CONFIG_ALIAS)->delete($oldMenuName);

        $menu = $this->processJsonFileName($newMenuName);

        return Storage::disk(self::FILE_CONFIG_ALIAS)->put($menu, $oldMenu);
    }

    /**
     * @return array
     */
    public function getAllMenuAsModelObject(): array
    {
        $files = Storage::disk(self::FILE_CONFIG_ALIAS)->allFiles();

        $fileObjects = [];

        if ($files) {
            foreach ($files as $file) {
                $file = str_replace('.json', '', $file);
                $obj = new \stdClass();
                $obj->id = $file;
                $obj->name = $file;
                $fileObjects[] = $obj;
            }
        }

        return $fileObjects;
    }

    /**
     * @param string $filename
     * @return string
     * @throws \Throwable
     */
    public function processJsonFileName(string $filename): string
    {
        $filename = trim($filename);

        $regex = preg_match("/^[a-zA-Z0-9_\-\s]{1,191}$/i", $filename);
        throw_if(!$regex, new \Exception('Invalid file name.'));

        $filename = strtolower(str_replace(' ', '_', $filename));

        return $this->addJsonExtension($filename);
    }

    private function addJsonExtension(string $filename): string
    {
        return (str_replace('.json', '', $filename) . '.json');
    }
}
