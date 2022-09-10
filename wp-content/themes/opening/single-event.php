<?php 
    // on utilise setup_postdata() pour faire le chargement de certaines données du post courant qui ne sont pas chargées par défaut (par ex. les données sur l'auteur)
    setup_postdata($post); 
    // ce template servira à afficher un post du CPT 'customer' => single-customer.php
    get_header(); 


?>

<main>

        <article class="single-event">

            <h1><?= get_the_title() ?></h1>

            <?php     
                
                $attachedMusicTerms = get_the_terms($post, 'style');
                    foreach ($attachedMusicTerms as $style) : 

                        $attachedPlaceTerms = get_the_terms($post, 'location');
                            foreach ($attachedPlaceTerms as $location) : 
            ?>
            <?php 
            global $wpdb;
            
            $postId = get_the_ID();            

            $table_name = $wpdb->prefix . "orga-event_date";
            // $table_name2 = $wpdb->prefix . "opening_user";
            // $table_name3 = $wpdb->prefix . "opening_posts";
                        
            $dbdates = $wpdb->get_results( "SELECT date FROM `$table_name` WHERE `organiser_id` = $postId" );
            // $dbdata = $wpdb->get_results( "SELECT `user_email` FROM `$table_name2` INNER JOIN $table_name3 ON $table_name2.key = $table_name3.key" );
            foreach($dbdates as $dbdate) : 
                
            ?>
                    <p>Date de l'évènement :<br><?= $dbdate->date ?></p>
            <?php endforeach ?>
            <p>Lieu : <?= $location->name ?></p>
            <p>Style de musique: <?= $style->name ?></p>

            <?php 
                    endforeach;
                endforeach;
            ?>

            <br>

            <p>Description : <br> <?= get_the_content() ?></p>

        </article>
        
        <div class="contact-event">

            <button class="contact-band__button"><a href="mailto:<?php echo get_the_author_meta('user_email');?>">Contacter</a></button>
            
        </div>    

</main>

<?php   get_footer(); ?>