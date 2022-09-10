<?php

namespace opening\Taxonomy;

use opening\PostType\BandPostType;
use opening\PostType\EventPostType;

class StyleTaxonomy {

    const TAXONOMY_KEY = "style";

    static public function register()
    {
        register_taxonomy(
            self::TAXONOMY_KEY,
            [BandPostType::POST_TYPE_KEY, EventPostType::POST_TYPE_KEY],
            [
                'hierarchical' => true,
                'labels' => ['name' =>  'Style'],
                'show_ui' => true
            ]
        );
    }

}
