<?php

namespace opening\Controller;

class OrganiserController {

    public function dashboard()
    {      
        global $organiserData;

        $currentUserObject = wp_get_current_user();

        if (! in_array('organiser', $currentUserObject->roles)) {
            exit ('Vous n\'avez pas accès à cette page');
        }

        $organiserData = $currentUserObject->to_array();
     
        $template = OPENING_THEME_URL . '/dashboard-organiser.tpl.php';

        return $template;
    }

    public function updateUser()
    {
        $currentUserObject = wp_get_current_user();

        if (! in_array('organiser', $currentUserObject->roles)) {
            
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

        return $this->redirect('/profil-organisateur');
    }

    private function redirect($to, $status = 302)
    {
        wp_redirect(WP_HOME.$to, $status);
    }
}