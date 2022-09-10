<?php

namespace opening\PostType;

class BandPostType extends PostType {
    
    const POST_TYPE_KEY = 'band';
    const POST_TYPE_LABEL = 'Band';
    const POST_TYPE_SLUG = 'groupe';

    const CAPABILITIES = [
        
        'edit_posts' => 'edit_bands',
        'publish_posts' => 'publish_bands',
        'edit_post' => 'edit_band',
        'read_post' => 'read_band',
        'delete_post' => 'delete_band',
        'edit_others_posts' => 'edit_others_bands',
        'delete_others_posts' =>  'delete_others_bands'
    ];
   
    const ADMIN_CAPS = [
        'edit_bands' => true, 
        'publish_bands' => true,
        'edit_band' => true,
        'read_band' => true,
        'delete_band' => true,
        'edit_others_bands' => true,
        'delete_others_bands' => true,
    ];
}
