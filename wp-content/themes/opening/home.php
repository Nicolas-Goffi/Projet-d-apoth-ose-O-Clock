<?php
get_header();
?>

<main class="band-list__global">

        <h1>ANNONCES/CONCERTS</h1>
    <div class="band-list__global--container-select">   

        <select name="department" id="department">
            <option value="#">Département</option>
            <option value="ain">Ain (01)</option>
            <option value="aisne">Aisne (02)</option>
            <option value="allier">Allier (03)</option>
            <option value="ahp">Alpes-haute-provence (04)</option>
            <option value="ht-alpes">Hautes-Alpes (05)</option>
            <option value="ardeche">Ardèche (07)</option>
        </select>
        
        <select name="music-style" id="music-style">
            <option value="#">Style de musique</option>
            <option value="rock">Rock</option>
            <option value="rap">Rap</option>
            <option value="classique">Classique</option>
            <option value="jazz">Jazz</option>
            <option value="funk">Funk</option>
            <option value="metal">Metal</option>
        </select>
    </div>   

        <section class="event-card">
        <?php
                if ( have_posts() ) : 
                    while ( have_posts() ) : the_post(); 
        ?>
            <div class="event-card__top">
                <p>Date de l'évènement <br> 10 septembre 2022</p>
                <p>Département : <br> Getigne (44)</p>
            </div>

            <h1><?= get_the_title() ?></h1>

            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolore est tempore odit autem nesciunt.</p>
        <?php 
                endwhile;    
            endif;
        ?>
        </section>

        <!-- <section class="event-card">
            <div class="event-card__top">
                <p>Date de l'évènement <br> 10 septembre 2022</p>
                <p>Département : <br> Getigne (44)</p>
            </div>

            <h1>Cherche groupe de rockabilly</h1>

            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolore est tempore odit autem nesciunt.</p>

        </section>

        <section class="event-card">
            <div class="event-card__top">
                <p>Date de l'évènement <br> 10 septembre 2022</p>
                <p>Département : <br> Getigne (44)</p>
            </div>

            <h1>Cherche groupe de rock</h1>

            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolore est tempore odit autem nesciunt.</p>

        </section> -->
    
    </main>   
    
<?php
get_footer();
?>