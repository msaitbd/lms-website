<?php

use Illuminate\Database\Migrations\Migration;

class AddNewPermissionForNewFeature02 extends Migration
{
    public function up()
    {
        $routes = [
            ['name' => 'Cookie/GDPR Setting', 'route' => 'setting.cookieSetting', 'type' => 2, 'parent_route' => 'settings'],
            ['name' => 'Theme Font', 'route' => 'appearance.themes-font.index', 'type' => 2, 'parent_route' => 'appearance'],
            ['name' => 'Class Details', 'route' => 'virtual-class.details', 'type' => 3, 'parent_route' => 'virtual-class.index'],
            ['name' => 'Class Edit', 'route' => 'custom.meetings.edit', 'type' => 3, 'parent_route' => 'virtual-class.details'],
        ];

        permissionUpdateOrCreate($routes);

    }

    public function down()
    {
        //
    }
}
