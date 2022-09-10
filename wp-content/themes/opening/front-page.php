<?php get_header(); ?>

<main class="main-card">
    <div class="main-intro-text">

        <p>Trouvez ou assurez la première partie de concerts dans votre département en fonction de votre style de musique.</p>
    </div> 
        
        <div class="you-are__container">
              
        <section class="you-are__organiser">
            <h2> Vous êtes un organisateur de concert :</h2>
            <ul>
            <?php 
                    // on récupère les emplacements de menu :
                    // => un array sous la forme [emplacement=>ID de menu]
                    $menuLocations = get_nav_menu_locations();
                    // le menu associé à notre emplacement "header-menu" se trouve dans $menuLocations['header-menu']
                    $headerMenuId = $menuLocations['organiser-menu'];
                    /* ALTERNATIVE : wp_nav_menu() 
                    $headerMenuId = wp_nav_menu(['theme_location'=>'header-menu']);
                    */
                    $menuItemList = wp_get_nav_menu_items($headerMenuId);

                    // pour chaque élément de menu récupéré
                    foreach ($menuItemList as $menuItem) :
                ?>
                <li><img src="<?= get_theme_file_uri() ?>/images/Ellipse_7.png" alt=""><a href="<?= $menuItem->url; ?>"><?= $menuItem->title; ?></a></li>
                <?php 
                    endforeach; 
                ?>
            </ul>
        </section>
       
        <section class="you-are__band">
            <h2>Vous êtes un groupe :</h2>
            <ul>
            <?php 
                    // on récupère les emplacements de menu :
                    // => un array sous la forme [emplacement=>ID de menu]
                    $menuLocations = get_nav_menu_locations();
                    // le menu associé à notre emplacement "header-menu" se trouve dans $menuLocations['header-menu']
                    $headerMenuId = $menuLocations['band-menu'];
                    /* ALTERNATIVE : wp_nav_menu() 
                    $headerMenuId = wp_nav_menu(['theme_location'=>'header-menu']);
                    */
                    $menuItemList = wp_get_nav_menu_items($headerMenuId);

                    // pour chaque élément de menu récupéré
                    foreach ($menuItemList as $menuItem) :
                ?>
                <li><img src="<?= get_theme_file_uri() ?>/images/Ellipse_7.png" alt=""><a href="<?= $menuItem->url; ?>"><?= $menuItem->title; ?></a></li>
                <?php 
                    endforeach; 
                ?>
            </ul>
        </section> 
        
    </div>
</main>

<?php get_footer(); ?>