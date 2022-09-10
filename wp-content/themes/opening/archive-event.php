<?php get_header(); ?>

<main class="band-list__global">

        <h1>LISTE DES ANNONCES</h1>

    <div class="band-list__global--container-select">   

    <?php $departmentsTerms = get_terms('location', array(
    'hide_empty' => false,
) );
          $styleTerms = get_terms('style');
         
    ?>
<form action="">

    <select onchange="this.form.submit()" name="department" id="department">

            <option value="">Tous les départements</option>
            <?php  foreach ($departmentsTerms as $department) : 
            ?>
            <option value="<?= $department->slug?>" 
            <?= $selected = $department->slug == $_GET['department'] ? "selected" : "" ?>>
            <?= $department->name?></option>
            <?php endforeach ?>

    </select>
        
    <select onchange="this.form.submit()" name="music-style" id="music-style">

            <option value="">Tous les styles</option>
            <?php  foreach ($styleTerms as $style) : 
            ?>
            <option value="<?= $style->slug ?>"
            <?= $selected = $style->slug == $_GET['music-style'] ? "selected" : "" ?>>
            <?= $style->name ?></option>
            <?php endforeach ?>
        
    </select>

</form>
    </div>   
     
    <?php 
        //Récupération de tous les post dans le CPT band        
        foreach($posts as $post) :  
            //Récupération de la taxonomy style de musique 
            $postId = get_the_ID();
            $attachedMusicTerms = get_the_terms($post, 'style', [
                'hyde empty' => false
            ]);
                    
            $attachedPlaceTerms = get_the_terms($post, 'location');

            global $wpdb;

            $table_name = $wpdb->prefix . "orga-event_date";
            
            $dbdates = $wpdb->get_results( "SELECT date FROM `$table_name` WHERE `organiser_id` = $postId" );
    ?>

            <section class="event-card">
                <a href="<?= get_post_permalink() ?>">

                <div class="event-card__top">
                    <?php foreach($dbdates as $dbdate) : ?>
                    <p>Date de l'évènement :<br><?= $dbdate->date ?></p>
                    <?php endforeach ?>
                    <p>Style de musique :<br> <?= $attachedMusicTerms[0]->name ?></p>
                    <p>Département :<br> <?= $attachedPlaceTerms[0]->name ?>  </p>
                </div>

                <h1>- <?= get_the_title()?> -</h1>

                <p><?= get_the_excerpt()?></p>
            </a>
            </section>
    
    <?php endforeach ?>
      
    </main>

<?php get_footer(); ?>