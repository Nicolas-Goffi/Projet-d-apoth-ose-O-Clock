<?php 
/* 
Template Name : page annonce
*/
get_header(); ?>

<?php 
        $departmentsTerms = get_terms('location', array(
            'hide_empty' => false,
        ) );
        $styleTerms = get_terms('style', array(
            'hide_empty' => false,
        ));
                
        //var_dump($styleTerms);
?>

    <main class="event-post">

        <h1>CREEZ VOTRE ANNONCES</h1>
        <form action="../evenement/" method="post"> 
        
            <div class="event-post__calendar">
                <label for="concert-date">Date du concert :</label>
                <input type="date" id="concert-date" name="concert-date"
                    value=""
                    min="2018-01-01" max="2100-12-12">
            </div>
        
            <div class= "event-post__select">
                <select onchange="this.form.submit()" name="concert-lieu" id="concert-lieu">

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
            </div>
            <br>

            <label for="titre">Titre:</label><br>
            <input type="text" id="titre" name="titre" value=""><br><br>
        
            <label for="annonce">Votre annonce:</label><br>
            <textarea id="annonce" name="annonce"
                      rows="5" cols="33">
            
            </textarea><br>

            <div class="event-post__button">
               <input type="submit" name="event-submit" id="submit" value="Envoyer">
            </div>
          
        </form> 

    </main>

<?php get_footer(); ?>