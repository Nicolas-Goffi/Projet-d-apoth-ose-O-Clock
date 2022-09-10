<?php
    use opening\Role\BandRole;
    use opening\Role\OrganiserRole;
?>
<p>
    <label for="user_role">Vous êtes...</label>
    <select id="user_role" name="user_role" class="input">
        <option value="">--Choisissez un rôle--</option>
        <option value="<?= BandRole::ROLE_KEY; ?>"><?= BandRole::ROLE_DISPLAY_NAME; ?></option>
        <option value="<?= OrganiserRole::ROLE_KEY; ?>"><?= OrganiserRole::ROLE_DISPLAY_NAME; ?></option>
    </select> 
</p>
<p>
    <label for="user_bandname">Nom du groupe</label>
    <input type="text" name="user_bandname" id="user_bandname" class="input" value="">
</p>
<p>
    <label for="user_password">Mot de passe</label>
    <input type="password" name="user_password" id="user_password" class="input" value="">
</p>
<p>
    <label for="user_password_confirm">Confirmez votre mot de passe</label>
    <input type="password" name="user_password_confirm" id="user_password_confirm" class="input" value="">
</p>
