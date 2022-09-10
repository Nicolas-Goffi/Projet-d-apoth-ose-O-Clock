<?php

namespace opening\Controller;

use opening\Taxonomy\LocationTaxonomy;
use opening\Taxonomy\StyleTaxonomy;

class BandController {

    public function dashboard()
    {      
        global $bandData;

        $currentUserObject = wp_get_current_user();

        if (! in_array('band', $currentUserObject->roles)) {
            exit ('Vous n\'avez pas accès à cette page');
        }
        
        $bandData = $currentUserObject->to_array();

        $attachedPostQuery = new \WP_Query([
            'post_type' => 'band',
            'posts_per_page' => 1,
            'author' => $bandData['ID'],
        ]);
      
        $attachedPost = $attachedPostQuery->posts[0];
        // add informations about current post needed for has_term() in dashboard-band.tpl.php
        $bandData['attachedPost'] = $attachedPost;
        
        $bandLocationTerms = get_the_terms($attachedPost, 'location');

        $bandStyleTerms = get_the_terms($attachedPost, 'style');
      
        $bandData['locations'] = $bandLocationTerms;

        $bandData['styles'] = $bandStyleTerms;        
        // change WP template by custom template     
        $template = OPENING_THEME_URL . '/dashboard-band.tpl.php';

        return $template;
    }

    public function updateUser()
    {
        $currentUserObject = wp_get_current_user();

        if (! in_array('band', $currentUserObject->roles)) {
            exit ('Vous n\'avez pas accès à cette page');
        }

        $userId = $currentUserObject->ID;

        if (!empty($_POST['user_password'])) {
            if (strlen($_POST['user_password']) >= 6 && $_POST['user_password'] === $_POST['user_password_confirm']) {
                wp_update_user([
                    'ID' => $userId,
                    'user_pass' => $_POST['user_password'],
                ]);
            } else {
                exit ('Le mot de passe doit contenir au moins 6 caractères et être identique dans les champs "Mot de passe" et "Confirmation du mot de passe"');
            }
        }

        wp_update_user([
            'ID' => $userId,            
            'user_email' => $_POST['user_email'],
        ]);

        // update taxonomy
        $attachedPostQuery = new \WP_Query([
            'post_type' => 'band',
            'posts_per_page' => 1,
            'author' => $userId,            
        ]);
        
        $attachedPost = $attachedPostQuery->posts[0];        
        $selectedStyle = $_POST['user_styles'];        
        wp_set_object_terms($attachedPost->ID, $selectedStyle, StyleTaxonomy::TAXONOMY_KEY);
        $selectedLocation = $_POST['user_locations'];
        wp_set_object_terms($attachedPost->ID, $selectedLocation, LocationTaxonomy::TAXONOMY_KEY);


        self::updateAttachedPost($attachedPost->ID);

        return $this->redirect('/profil-groupe');
    }

    static public function updateAttachedPost($postId)
    {
        wp_update_post([
            'ID' => $postId,
            'post_title' => $_POST['user_bandname'],
            'post_content' => $_POST['band_biography'],
        ]);

        $postMeta = [
            '_facebook-meta-data' => $_POST['user_facebook_url'],
            '_bandcamp-meta-data' => $_POST['user_bandcamp_url'],
            '_soundcloud-meta-data' => $_POST['user_soundcloud_url'],
        ];

        foreach ($postMeta as $key => $postValue) {
            update_post_meta(
                $postId,
                $key,
                $postValue,
            );
        }

        $file_name = $_FILES['thumbnail']['name'];
        $file_temp = $_FILES['thumbnail']['tmp_name'];
        
        if (!empty($file_temp)) {

            $upload_dir = wp_upload_dir();
            $image_data = file_get_contents($file_temp);
            $filename = basename($file_name);
            $filetype = wp_check_filetype($file_name);
            $filename = time().'.'.$filetype['ext'];

            if (wp_mkdir_p($upload_dir['path'])) {
                $file = $upload_dir['path'] . '/' . $filename;
            } else {
                $file = $upload_dir['basedir'] . '/' . $filename;
            }

            file_put_contents($file, $image_data);
            $wp_filetype = wp_check_filetype($filename, null);
            $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => sanitize_file_name($filename),
            'post_content' => '',
            'post_status' => 'inherit'
            );

            $attach_id = wp_insert_attachment($attachment, $file);
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            $attach_data = wp_generate_attachment_metadata($attach_id, $file);
            wp_update_attachment_metadata($attach_id, $attach_data);

            set_post_thumbnail($postId, $attach_id);
        }
    }

    private function redirect($to, $status = 302)
    {
        wp_redirect(WP_HOME.$to, $status);
    }
}