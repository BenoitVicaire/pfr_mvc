<!-- Si utilisateur/trice est non identifié(e), on affiche le formulaire -->
<?php if (!isset($_SESSION['logged'])) : ?>
    <form action="index.php?action=submitLogin" method="POST">
        <!-- si message d'erreur on l'affiche -->
        <?php if (isset($_SESSION['LOGIN_ERROR_MESSAGE'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['LOGIN_ERROR_MESSAGE'];
                unset($_SESSION['LOGIN_ERROR_MESSAGE']); ?>
            </div>
        <?php endif; ?>
        <div>
            <label for="email" >Email</label>
            <input type="email" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com">
            <div id="email-help" >L'email utilisé lors de la création de compte.</div>
        </div>
        <div>
            <label for="password" >Mot de passe</label>
            <input type="password"  id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
    <!-- Formulaire Creation de compte -->
    <form action="index.php?action=submitCreateAccount" method="post">
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="password">password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="name">name</label>
            <input type="text" name="name" id="name" required>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
    <!-- Si utilisateur/trice bien connectée on affiche un message de succès -->
<?php else : ?>
    <div>
        Bonjour <?php echo $_SESSION['user']['email']; ?> et bienvenue sur le site !
        <a href="index.php">Revenir à la page d'accueil</a>
    </div>
<?php endif; ?>


<?php 
if(!empty($succesMessage)):?>
    <div>
        <h3>Félicitation!</h3>
        <?= htmlspecialchars($succesMessage) ?>
    </div>
<?php endif ?>
