<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuList;

class MenuListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menuData = [
            [
                'menu_group' => 'Dashboard',
                'menu_item' =>  json_encode([
                    "menu_id" => "dashboard",
                    "menu_title" => "Dashboard",
                    "route" => "dashboard",
                    "icon" => "fas fa-tachometer-alt"
                ]),
                'sort_order' => 10
            ],
            [
                'menu_group' => 'Users',
                'menu_item' =>  json_encode([
                    "menu_id" => "users",
                    "menu_title" => "User Management",
                    "route" => "#",
                    "icon" => "fas fa-users",
                    "items" =>  [
                        [
                            "menu_id" => "users",
                            "menu_title" => "Show Users",
                            "route" => "users",
                            "icon" => "fas fa-eye"
                        ],[
                            "menu_id" => "add_user",
                            "menu_title" => "Add User",
                            "route" => "users_add",
                            "icon" => "fas fa-plus-circle"
                        ]
                    ]
                ]),
                'sort_order' => 20
            ],
            [
                'menu_group' => 'Roles',
                'menu_item' =>  json_encode([
                    "menu_id" => "roles",
                    "menu_title" => "Role Management",
                    "route" => "#",
                    "icon" => "fas fa-user-tag",
                    "items" =>  [
                        [
                            "menu_id" => "roles",
                            "menu_title" => "Show Roles",
                            "route" => "roles",
                            "icon" => "fas fa-eye"
                        ],[
                            "menu_id" => "add_role",
                            "menu_title" => "Add Role",
                            "route" => "roles_add",
                            "icon" => "fas fa-plus-circle"
                        ]
                    ]
                ]),
                'sort_order' => 30
            ],
            [
                'menu_group' => 'Menus',
                'menu_item' =>  json_encode([
                    "menu_id" => "menus",
                    "menu_title" => "Menu Management",
                    "route" => "#",
                    "icon" => "fas fa-bars",
                    "items" =>  [
                        [
                            "menu_id" => "menus",
                            "menu_title" => "Menus",
                            "route" => "menus",
                            "icon" => "fas fa-eye"
                        ],[
                            "menu_id" => "add_menu",
                            "menu_title" => "Add Menu",
                            "route" => "menus_add",
                            "icon" => "fas fa-plus-circle"
                        ]
                    ]
                ]),
                'sort_order' => 40
            ],
            [
                'menu_group' => 'Reports',
                'menu_item' =>  json_encode([
                    "menu_id" => "reports",
                    "menu_title" => "Reports",
                    "route" => "#",
                    "icon" => "fas fa-flag",
                    "items" =>  [
                        [
                            "menu_id" => "admin_log",
                            "menu_title" => "Admin Activity",
                            "route" => "reports_adminlog",
                            "icon" => "fas fa-clipboard-list"
                        ]
                    ]
                ]),
                'sort_order' => 50
            ],
            [
                'menu_group' => 'Settings',
                'menu_item' =>  json_encode([
                    "menu_id" => "settings",
                    "menu_title" => "Settings",
                    "route" => "#",
                    "icon" => "fas fa-sliders-h",
                    "items" =>  [
                        [
                            "menu_id" => "configuration",
                            "menu_title" => "Configuration",
                            "route" => "settings_configuration",
                            "icon" => "fas fa-cog"
                        ],[
                            "menu_id" => "integration",
                            "menu_title" => "Integration",
                            "route" => "settings_integration",
                            "icon" => "fas fa-link"
                        ],[
                            "menu_id" => "cache_management",
                            "menu_title" => "Cache Management",
                            "route" => "settings_cache_management",
                            "icon" => "fas fa-database"
                        ]
                    ]
                ]),
                'sort_order' => 60
            ],
            [
                'menu_group' => 'Financehub',
                'menu_item' =>  json_encode([
                    "menu_id" => "financehub",
                    "menu_title" => "Finance Hub",
                    "route" => "#",
                    "icon" => "fas fa-wallet",
                    "items" =>  [
                        [
                            "menu_id" => "transactions",
                            "menu_title" => "Transactions",
                            "route" => "financehub_transactions",
                            "icon" => "fas fa-exchange-alt"
                        ],[
                            "menu_id" => "categories",
                            "menu_title" => "Categories",
                            "route" => "financehub_categories",
                            "icon" => "fas fa-tags"
                        ],[
                            "menu_id" => "budgets",
                            "menu_title" => "Budgets",
                            "route" => "financehub_budgets",
                            "icon" => "fas fa-balance-scale"
                        ],[
                            "menu_id" => "financial_insights",
                            "menu_title" => "Financial Insights",
                            "route" => "financehub_financial_insights",
                            "icon" => "fas fa-chart-line"
                        ]
                    ]
                ]),
                'sort_order' => 10
            ]
        ];
        MenuList::upsert($menuData, ['menu_group']);
    }
}
