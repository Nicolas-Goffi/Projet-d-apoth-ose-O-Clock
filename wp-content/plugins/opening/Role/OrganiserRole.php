<?php

namespace opening\Role;

class OrganiserRole
{
    const ROLE_KEY = "organiser";
    const ROLE_DISPLAY_NAME = "Organisateur";

    static public function register()
    {
        add_role(
            self::ROLE_KEY,
            self::ROLE_DISPLAY_NAME,
            [
                'read' => true,
                'edit_posts' => true,
                'edit_events' => true,
                'publish_events' => true,
                'edit_event' => true,
                'read_event' => true,
                'delete_event' => true,
                'edit_others_events' => false,
                'delete_others_events' => false
            ]
        );
    }

    static public function unregister()
    {
        remove_role('organiser');
    }
}
