<?php
// var_dump($bandData);
?>

<?php

use opening\Classes\FormField;
use opening\Taxonomy\StyleTaxonomy;
use opening\Taxonomy\LocationTaxonomy;

$formFieldList = [];

$formFieldList[] = new FormField('Nom du groupe', 'user_bandname', 'text', $bandData['attachedPost']->post_title, 'Le nom de votre groupe');
$formFieldList[] = new FormField('Email', 'user_email', 'email', $bandData['user_email'], 'Votre adresse email');
$formFieldList[] = new FormField('Mot de passe', 'user_password', 'password', '', 'Modifier votre mot de passe');
$formFieldList[] = new FormField('Confirmation du mot de passe', 'user_password_confirm', 'password', '', 'Confirmez votre mot de passe');
$formFieldList[] = new FormField('Adresse Facebook', 'user_facebook_url', 'text', get_post_meta($bandData['attachedPost']->ID)['_facebook-meta-data'][0], 'Votre adresse Facebook');
$formFieldList[] = new FormField('Adresse Soundcloud', 'user_soundcloud_url', 'text', get_post_meta($bandData['attachedPost']->ID)['_soundcloud-meta-data'][0], 'Votre adresse Soundcloud');
$formFieldList[] = new FormField('Adresse Bandcamp', 'user_bandcamp_url', 'text', get_post_meta($bandData['attachedPost']->ID)['_bandcamp-meta-data'][0], 'Votre adresse Bandcamp');

get_header();

?>

<main class="band-dashboard__container">
    <h1>Profil : <?= $bandData['display_name'] ?></h1>

    <form action="" method="post" class="band-dashboard__form" enctype="multipart/form-data">

        <?php foreach ($formFieldList as $formField) : ?>
        <div class="band-dashboard__form">
            <label for="<?= $formField->getName(); ?>"><?= $formField->getLabel(); ?> : </label><br>
            <input 
            id="<?= $formField->getName(); ?>"
            name="<?= $formField->getName(); ?>"
            type="<?= $formField->getType(); ?>"
            value="<?= $formField->getValue(); ?>"
            placeholder="<?= $formField->getPlaceholder(); ?>">
        </div>
        <?php endforeach; ?>

                <select name="user_styles[]">
                    <?php
                        $allStylesList = get_terms([
                            'taxonomy' => StyleTaxonomy::TAXONOMY_KEY,
                            'hide_empty' => false,

                        ]);                    
                        foreach ($allStylesList as $style) :            
                            // has_terms arguments : term, taxonomy, post. Match = true.
                            $currentBandHasStyle = has_term($style->term_id, StyleTaxonomy::TAXONOMY_KEY, $bandData['attachedPost']);
                            $selected = "";
                            if($currentBandHasStyle) {
                                $selected = "selected";
                            }
                    ?>
                        <option <?= $selected; ?> value="<?= $style->slug; ?>"><?= $style->name; ?></option>
                    <?php endforeach; ?>
                </select>

                <select name="user_locations[]">
                    <?php
                        $allLocationsList = get_terms([
                            'taxonomy' => LocationTaxonomy::TAXONOMY_KEY,
                            'hide_empty' => false,

                        ]);                    
                        foreach ($allLocationsList as $location) :            
                            // has_terms arguments : term, taxonomy, post. Match = true.
                            $currentBandHasLocation = has_term($location->term_id, LocationTaxonomy::TAXONOMY_KEY, $bandData['attachedPost']);
                            $selected = "";
                            if($currentBandHasLocation) {
                                $selected = "selected";
                            }
                    ?>
                        <option <?= $selected; ?> value="<?= $location->slug; ?>"><?= $location->name; ?></option>
                    <?php endforeach; ?>
                </select>


        <div class="band-dashboard__thumbnail">
            <label for="thumbnail">Illustration du groupe :</label>
            <input
            id="thumbnail"
            name="thumbnail"
            type="file"            
            accept="image/png, image/jpeg">
        </div>

        <div class="band-dashboard__form">

            <label for="band_biography">Présentation du groupe :</label><br>
            <textarea id="band_biography" name="band_biography"  cols="60" rows="10"><?= $bandData['attachedPost']->post_content; ?></textarea>

        </div>

        <div class="band-dashboard__button">
        <button class="event-create__button" role="submit">Enregistrer</button>
        </div>

    </form>

</main>

<?php get_footer(); ?>