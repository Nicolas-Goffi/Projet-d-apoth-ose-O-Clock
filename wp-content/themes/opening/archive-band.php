<?php get_header(); ?>

<main class="band-list__global">

<?php //var_dump(get_departements())?>

        <h1>PROFIL DES GROUPES</h1>

    <div class="band-list__global--container-select">   

    <?php $departmentsTerms = get_terms('location', array(
    'hide_empty' => false,
) );

        $styleTerms = get_terms('style', array(
            'hide_empty' => false,
        ));
         
        //var_dump($departmentsTerms);
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

// $attachedLocationTerms = get_terms($post, 'location');
// var_dump($attachedLocationTerms);
               
        //Récupération de tous les post dans le CPT band        
        foreach($posts as $post) :  
            //Récupération de la taxonomy style de musique 
            $attachedStyleTerms = get_the_terms($post, 'style');
            $attachedLocationTerms = get_the_terms($post, 'location');
            //var_dump($attachedLocationTerms);
    ?>
        <!-- Dynamisation de la page band-list -->
        <section class="band-card">
            <a href="<?= get_post_permalink() ?>">
            <div class="band-card__top">
                <p>Style de musique : <br> <?= $attachedStyleTerms[0]->name ?> </p>
                <p>Département : <br> <?= $attachedLocationTerms[0]->name ?> </p>
            </div>

            <h1>- <?= get_the_title()?> -</h1>

            <p><?= get_the_excerpt()?></p>
            </a>
        </section>
            
        <?php endforeach ?>

      
    </main>

<?php get_footer(); ?>