<?php

namespace opening;

use opening\PostType\BandPostType;
use opening\PostType\EventPostType;
use opening\Role\BandRole;
use opening\Role\OrganiserRole;
use opening\Taxonomy\StyleTaxonomy;
use opening\Taxonomy\LocationTaxonomy;
use opening\Classes\Registration;
use opening\Classes\Router;
use opening\Classes\Database;

class Plugin {
    

    public function run()
    {
        add_action('init', [$this, 'onInit']);

        Registration::init();

        Router::preinit();

        register_activation_hook(
            OPENING_PLUGIN_FILE,
            [$this, 'onPluginActivation']
        );

        register_deactivation_hook(
            OPENING_PLUGIN_FILE,
            [$this, 'onPluginDeactivation']
        );

    }

    //https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/
    //On rajouter les custom boxes 
    function add_custom_box() { 
        //une box pour facebook 
        add_meta_box(
             'facebook_link', // id de la metabox
             'Lien facebook', // titre de la custom box
             [$this, 'fbHtml'],  // appel de la fonction qui affiche le html
             'band', // Nom du post type
         );
        //une box pour bandcamp
         add_meta_box(
            'bandcamp_link', // id de la metabox
            'Lien bandcamp', // titre de la custom box
            [$this, 'bcHtml'],  // appel de la fonction qui affiche le html
            'band', // Nom du post type
        );
        //une box pour soundcloud
        add_meta_box(
            'soundclound_link', // id de la metabox
            'Lien soundcloud', // titre de la custom box
            [$this, 'scHtml'],  // appel de la fonction qui affiche le html
            'band', // Nom du post type
        );
    }
 
    //On insere le code html que l'on veut placer dans la box facebook
    function fbHtml($post) {
        $value = get_post_meta( $post->ID, '_facebook-meta-data', true );       
        ?>
            <label for="fblink">Liens Facebook</label>
            <input type="text" id="fblink" name="fblink" value="<?= $value ?>">
        <?php 
    }
    //On insere le code html que l'on veut placer dans la box bandcamp
    function bcHtml($post) {
        $value = get_post_meta( $post->ID, '_bandcamp-meta-data', true );
        ?>
            <label for="bclink">Liens Bandcamp</label>
            <input type="text" id="bclink" name="bclink" value="<?= $value ?>">
        <?php 
    }
    //On insere le code html que l'on veut placer dans la box soundcloud
     function scHtml($post) {
        $value = get_post_meta( $post->ID, '_soundcloud-meta-data', true );
        ?>
            <label for="sclink">Liens Soundcloud</label>
            <input type="text" id="sclink" name="sclink" value="<?= $value ?>">
        <?php 
    }
    //On sauvegarde les données envoyer depuis la box dans la bdd
    function wporg_save_fb_postdata( $post_id ) {
        if ( array_key_exists( 'fblink', $_POST ) ) {
            update_post_meta(
                $post_id,
                '_facebook-meta-data',
                $_POST['fblink']
            );
        }
    }
    //On sauvegarde les données envoyer depuis la box dans la bdd
    function wporg_save_bc_postdata( $post_id ) {
        if ( array_key_exists( 'bclink', $_POST ) ) {
            update_post_meta(
                $post_id,
                '_bandcamp-meta-data',
                $_POST['bclink']
            );
        }
    }
    //On sauvegarde les données envoyer depuis la box dans la bdd
    function wporg_save_sc_postdata( $post_id ) {
        if ( array_key_exists( 'sclink', $_POST ) ) {
            update_post_meta(
                $post_id,
                '_soundcloud-meta-data',
                $_POST['sclink']
            );
        }
    }

    public function onInit()
    {
        $this->registerPostTypes();
        $this->registerTaxonomies();

        Router::init();        

        add_action( 'add_meta_boxes', [$this, 'add_custom_box'] );
        add_action( 'save_post', [$this,'wporg_save_fb_postdata'] );
        add_action( 'save_post', [$this,'wporg_save_bc_postdata'] );
        add_action( 'save_post', [$this,'wporg_save_sc_postdata'] );


        // utilisé pour récuperer les données de l'api en une seule fois et ne pas recharger les données à chaque rechargement de wordpress
        $loadDepartment = isset($_GET['loaddepartment']) ? $_GET['loaddepartment'] : null;
        if ($loadDepartment == true) {
            $this->get_departements();
        }
    }

    

    private function registerPostTypes()
    {
        BandPostType::register();
        EventPostType::register();
    }

    private function registerTaxonomies()
    {
        StyleTaxonomy::register();
        LocationTaxonomy::register();
    }

    public function get_departements() {

        $url = 'https://geo.api.gouv.fr/departements';
        $response = wp_remote_get($url);
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
    
        foreach ($data as $departement) {
            wp_insert_term($departement ['nom'], 
            'location', 
            array(
                'description' => $departement['code'],
                'slug' => $departement['code']
            ));
            
        }
        
    }

    public function onPluginActivation()
    {        
        BandPostType::addAdminCaps();
        EventPostType::addAdminCaps();

        BandRole::register();
        OrganiserRole::register();
              
        Database::generateTables();        
    }

    public function onPluginDeactivation()
    {                
        BandRole::unregister();
        OrganiserRole::unregister();
    }
}