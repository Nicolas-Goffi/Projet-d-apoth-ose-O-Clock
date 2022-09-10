<?php 
  
    // on utilise setup_postdata() pour faire le chargement de certaines données du post courant qui ne sont pas chargées par défaut (par ex. les données sur l'auteur)
    setup_postdata($post); 
    // ce template servira à afficher un post du CPT 'customer' => single-customer.php
    get_header(); 

?>

<main>
        <section class="band-single">

        <h3>Profil de</h3>

        <h1>- <?= the_title() ?> -</h1>
       
        <nav>
            <a href="<?= get_post_meta($post->ID)['_facebook-meta-data'][0] ; ?>"><img src="<?= get_theme_file_uri() ?>/images/facebook.png" alt="facebook"></a>
            <a href="<?= get_post_meta($post->ID)['_bandcamp-meta-data'][0] ; ?>"><img src="<?= get_theme_file_uri() ?>/images/soundcloud.png" alt="soundcloud"></a>
            <a href="<?= get_post_meta($post->ID)['_soundcloud-meta-data'][0] ; ?>"><img src="<?= get_theme_file_uri() ?>/images/logo-de-bandcamp.png" alt="bandcamp"></a>
        </nav>
                 
        </section>
        <div class="band-single__card">
            <section class="band-single__card--left">
            <?= get_the_post_thumbnail(); ?>
            </section>
            <section class="band-single__card--right">

                <div class="band-single__card--right--select">
                    
            <?php     
                foreach($posts as $post) :

                    $attachedStyleTerms = get_the_terms($post, 'style');
                    foreach ($attachedStyleTerms as $style) : 

                        $attachedLocationTerms = get_the_terms($post, 'location');
                            foreach ($attachedLocationTerms as $location) : 
            ?>

                    <p>Style de musique : <br> <?= $style->name ?></p>
                    <p>Département : <br> <?= $location->name ?></p>
                            
                        <?php endforeach ?>
                    <?php endforeach ?>
                <?php endforeach ?>

            </div>
            
                <h3>Description :</h3>
                
                <p><?= get_the_content() ?></p>
               
            </section>
        </div>
                        
        <div class="contact-band">
            <button class="contact-band__button"><a href="mailto:<?php echo get_the_author_meta('user_email');?>">Contacter</a></button>
        </div>

    </main>

<?php   get_footer(); ?>