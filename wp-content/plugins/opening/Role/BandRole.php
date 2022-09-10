<?php

namespace opening\Role;

class BandRole
{

    const ROLE_KEY = "band";
    const ROLE_DISPLAY_NAME = "Groupe";

    static public function register()
    {
        add_role(
            self::ROLE_KEY,
            self::ROLE_DISPLAY_NAME,
            [
                'read' => true,
                'edit_posts' => true,
                'edit_bands' => true,
                'publish_bands' => true,
                'edit_band' => true,
                'read_band' => true,
                'delete_band' => true,
                'edit_others_bands' => false,
                'delete_others_bands' => false
            ]
        );
    }

    static public function unregister()
    {
        remove_role('band');
    }
}
