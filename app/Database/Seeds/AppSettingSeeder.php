<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AppSettingSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'type' => 'setting',
            'name' => 'layout_setting',
            'value' => '{
                "saveLocal": "",
                "storeKey": "huisetting",
                "setting": {
                    "app_name": { "value" : "Hope UI"},
                    "theme_scheme_direction": { "value": "ltr" },
                    "theme_scheme": { "value": "light" },
                    "theme_color": { "value": "theme-color-default" },
                    "theme_style_appearance": {"value": []},
                    "theme_transition": {"value": null},
                    "theme_font_size": {"value": "theme-fs-md"},
                    "page_layout": {"value" : "container-fluid"},
                    "header_navbar": {"value" : "default"},
                    "header_banner": {"value" : "default"},
                    "sidebar_color": {"value" : "sidebar-white"},
                    "sidebar_type" : {"value" : []},
                    "sidebar_menu_style": {"value" : "navs-rounded-all"},
                    "card_color": {"value": "card-default"},
                    "footer": {"value" : "default"},
                    "body_font_family": {"value" : null},
                    "heading_font_family": {"value" : null}
                }
            }',
            'status' => 1,
            'is_global' => 1,
        ];
        $this->db->table('app_setting')->insert($data);
    }
}
