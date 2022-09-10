<?php

namespace opening\Classes;

use opening\Controller\BandController;
use opening\Controller\OrganiserController;

class Router {
    /**
     * To allow query var
     *
     * @return void
     */
    static public function preinit()
    {
        add_filter('query_vars', function($query_vars) {
            $query_vars[] = 'opening_route';
            return $query_vars;
        });
    }

    static public function init()
    {
        self::registerRewrites();

        add_filter('template_include', function($template) {
            // to get the HTTP current method
            $httpMethod = $_SERVER['REQUEST_METHOD'];
        
            if (get_query_var('opening_route') === "profil-groupe" && $httpMethod === 'GET') {               
                $controller = new BandController();      
                $template = $controller->dashboard();
            }

            else if (get_query_var('opening_route') === "profil-groupe" && $httpMethod === 'POST') {
                $controller = new BandController();
                $template = $controller->updateUser();
            }

            else if (get_query_var('opening_route') === "profil-organisateur" && $httpMethod === 'GET') {
                $controller = new OrganiserController();    
                $template = $controller->dashboard();
            }   

            else if (get_query_var('opening_route') === "profil-organisateur" && $httpMethod === 'POST') {
                $controller = new OrganiserController();
                $template = $controller->updateUser();
            }    
            
            return $template;
        });
    }

    static public function registerRewrites()
    {
        add_rewrite_rule('profil-groupe[/]?$', 'index.php?opening_route=profil-groupe', 'top');
        add_rewrite_rule('profil-organisateur[/]?$', 'index.php?opening_route=profil-organisateur', 'top');        

        flush_rewrite_rules();
    }
}
