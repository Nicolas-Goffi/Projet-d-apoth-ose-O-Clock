<?php

namespace opening\PostType;

class PostType {   

    static public function register()
    {
        register_post_type (
        
            static::POST_TYPE_KEY,
            [
                'label' => static::POST_TYPE_LABEL,
                'public' => true,
                'has_archive' => true,
                'rewrite' => ['slug' => static::POST_TYPE_SLUG],
                'capabilities' => static::CAPABILITIES,
                'supports' => [
                    'title',
                    'editor',
                    'thumbnail',
                ],
            ]
        );
    }

    static public function addAdminCaps()
    {        
        $adminRole = get_role('administrator');
        
        foreach (static::ADMIN_CAPS as $cap => $grant) {
         
            $adminRole->add_cap($cap, $grant);
        }
    }

    static public function removeAdminCaps()
    {       
        $adminRole = get_role('administrator');
    
        foreach (static::ADMIN_CAPS as $cap => $grant) {
      
            $adminRole->remove_cap($cap);
        }
    }
}
