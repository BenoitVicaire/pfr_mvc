<?php $title = "Loggin";
$page = 'login';

ob_start(); ?>
<!-- Si utilisateur/trice est non identifié(e), on affiche le formulaire -->
<section class="loginContainer">
    <?php if (!isset($_SESSION['logged'])) : ?>
        <div class="tabs">
            <div class="tabButtons">
                <button class="tabBtn active" data-tab="inscription">S'inscrire</button>
                <button class="tabBtn" data-tab="connexion">Se Connecter</button>
            </div>

            <div class="tabContent active" id="inscription">
                <h2>S'inscrire</h2>

                <!-- Formulaire Creation de compte -->
            <form action="index.php?action=submitCreateAccount" class="loginForm" method="post">
                <div>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                </div>
                <div>
                    <input type="password" name="password" id="password" placeholder="Password">
                </div>
                <div>
                    <input type="password" name="password2" id="password2" placeholder="Veuillez verifier votre Password">
                </div>
                <div>
                    <input type="text" name="name" id="name" placeholder="Name">
                </div>
                <button type="submit" class="btn btn-primary" id="btnSubmitCreate">Créer le compte</button>
            </form>

            </div>
            <div class="tabContent" id="connexion">
                <h2>Se Connecter</h2>

                <form action="index.php?action=submitLogin" method="POST" class="loginForm">

                <!-- si message d'erreur on l'affiche -->
                <?php if (isset($_SESSION['LOGIN_ERROR_MESSAGE'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION['LOGIN_ERROR_MESSAGE'];
                        unset($_SESSION['LOGIN_ERROR_MESSAGE']); ?>
                    </div>
                <?php endif; ?>
                <div>
                    <input type="email" id="email" name="email" placeholder="Email">
                   
                </div>
                <div>
                    <input type="password"  id="password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Connexion</button>
            </form>
            </div>
        </div>
        <!-- Si utilisateur/trice bien connectée on affiche un message de succès -->
    <?php else : ?>
        <div class="welcomeMessage">
            <p>Bonjour <?php echo $_SESSION['user']['email']; ?> et bienvenue sur le site !
            <a href="index.php">Revenir à la page d'accueil</a>
        </div>
    <?php endif; ?>
    <?php 
        if(!empty($succesMessage)):?>
            <div class="successMessage">
                <h3>Félicitation!</h3>
                <?= htmlspecialchars($succesMessage) ?>
            </div>
    <?php endif ?>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('layout.php') ?>
