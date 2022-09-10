<?php

namespace opening\Classes;

use opening\Role\BandRole;
use opening\Role\OrganiserRole;

class Registration {

    static public function init()
    {
        add_action('register_form', [self::class, 'displayCustomFields']);

        add_filter('registration_errors', [self::class, 'validateCustomFields']);
       
        add_action('user_register', [self::class, 'userRegistered']);

        add_action('login_enqueue_scripts', [self::class, 'loginEnqueueAssets']);
    }

    static public function displayCustomFields()
    {
        require OPENING_TEMPLATES_DIR . '/register-form.tpl.php';
    }
    
    static public function validateCustomFields($errors, $userLogin = null, $userEmail = null)
    {
        define('OPENING_ERROR_CODE_PREFIX', 'opening-registration-');
   
        if (! in_array($_POST['user_role'], [BandRole::ROLE_KEY, OrganiserRole::ROLE_KEY])) {
            $errors->add(OPENING_ERROR_CODE_PREFIX . 'wrong-role', __("<strong>Erreur</strong>: Le rôle sélectionné n'est pas valide."));
        }

        if (empty($_POST['user_bandname']) && $_POST['user_role'] === BandRole::ROLE_KEY) {
            $errors->add('user_bandname_error', __( '<strong>Erreur</strong>: Veuillez indiquer le nom de votre groupe.' ));
        }
       
        if (empty($_POST['user_password']) || strlen($_POST['user_password']) < 6) {            
            $errors->add(OPENING_ERROR_CODE_PREFIX . 'wrong-password', __("<strong>Erreur</strong>: Le mot de passe est invalide."));
        }
        
        if (empty($_POST['user_password_confirm']) || $_POST['user_password_confirm'] !== $_POST['user_password']) {
            $errors->add('user_password_confirmed_error', __( '<strong>Erreur</strong>: Veuillez confirmer votre mot de passe.' ));
        }
        
        return $errors;
    }

    static public function userRegistered($userId)
    {
        $newUser = get_userdata($userId);
        
        if ($newUser === false) {
            return;
        }
       
        $newUser->add_role($_POST['user_role']);

        wp_update_user([
            'ID' => $userId,
            'user_pass' => $_POST['user_password'],                 
        ]);
        
        update_user_meta(
            $userId,
            'user_bandname',
            $_POST['user_bandname']
        );
       
        self::generateAttachedPost($userId);
    }

    static public function generateAttachedPost($userId)
    {        
        wp_insert_post([
            'post_title' => $_POST['user_bandname'],
            'post_type' => $_POST['user_role'],
            'post_author' => $userId,
            'post_status' => 'publish',
        ]);
    }

    static public function loginEnqueueAssets()
    {
        wp_enqueue_script( 'registration-form', OPENING_PLUGIN_URL . '/assets/js/registration-form.js', [], false, true);
    }
}
