<?php

use opening\Classes\FormField;

$formFieldList = [];

$formFieldList[] = new FormField('Email', 'user_email', 'email', $organiserData['user_email'], 'Votre adresse email');
$formFieldList[] = new FormField('Mot de passe', 'user_password', 'password', '', 'Modifier votre mot de passe');
$formFieldList[] = new FormField('Confirmation du mot de passe', 'user_password_confirm', 'password', '', 'Confirmez votre mot de passe');

get_header();

?>

<main class="band-dashboard__container">
    <h1>Profil : <?= $organiserData['display_name'] ?></h1>

    <form action="" method="POST" class="band-dashboard__form">

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

        <div class="band-dashboard__button">
        <button class="event-create__button" role="submit">Enregister</button>
        </div>
        
    </form>

  
  <div class="event-create">
  <button class="event-create__button"><a href="<?= home_url( '/annonce/' ) ?>">Déposer une annonce</a></button>
  </div>

</main>
<?php get_footer(); ?>