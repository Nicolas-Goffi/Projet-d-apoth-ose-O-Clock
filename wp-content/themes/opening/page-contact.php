<?php get_header(); ?>

<main class="contact">
        <div class="contact__contenair-form">
            <h2 class="contact__title">Contactez-nous :</h2>
            <form action="/action_page.php">
                <label for="email">Votre email:</label><br>
                <input type="text" id="email" name="email" value=""><br>
            
                <label for="message">Votre message:</label><br>
                <textarea id="message" name="message"
                    rows="15" cols="33">
                
                </textarea><br>
                <div class="contact__button">
                <input  type="submit" value="Envoyer">
                </div>
            </form> 
        </div>

        <section class="contact__contenair-adress">
            <p>Opening<br>7 place O'clock<br>07400 Le Teil</p>
        </section>

</main>

<?php get_footer(); ?>