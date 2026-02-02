<?php $title = "Loggin";
$page = 'login';

ob_start(); ?>
<section class="loginContainer">
    <?php if (!isset($_SESSION['logged'])) : ?>
        <div class="tabs">
            <div class="tabButtons">
                <button class="tabBtn active" data-tab="inscription" data-i18n="tab_register"></button>
                <button class="tabBtn" data-tab="connexion" data-i18n="tab_login"></button>
            </div>

            <div class="tabContent active" id="inscription">
                <h2 data-i18n="register_title"></h2>

                <form action="index.php?action=submitCreateAccount" class="loginForm" method="post">
                    <div>
                        <input type="email" name="email" id="email" data-i18n-placeholder="email_placeholder" placeholder="">
                    </div>
                    <div>
                        <input type="password" name="password" id="password" data-i18n-placeholder="password_placeholder" placeholder="">
                    </div>
                    <div>
                        <input type="password" name="password2" id="password2" data-i18n-placeholder="password_confirm_placeholder" placeholder="">
                    </div>
                    <div>
                        <input type="text" name="name" id="name" data-i18n-placeholder="name_placeholder" placeholder="">
                    </div>
                    <button type="submit" class="btn btn-primary" id="btnSubmitCreate" data-i18n="create_account_btn"></button>
                </form>
            </div>

            <div class="tabContent" id="connexion">
                <h2 data-i18n="login_form_title"></h2>

                <form action="index.php?action=submitLogin" method="POST" class="loginForm">
                    <?php if (isset($_SESSION['LOGIN_ERROR_MESSAGE'])) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['LOGIN_ERROR_MESSAGE'];
                            unset($_SESSION['LOGIN_ERROR_MESSAGE']); ?>
                        </div>
                    <?php endif; ?>
                    <div>
                        <input type="email" id="email" name="email" data-i18n-placeholder="email_placeholder" placeholder="">
                    </div>
                    <div>
                        <input type="password" id="password" name="password" data-i18n-placeholder="password_placeholder" placeholder="">
                    </div>
                    <button type="submit" class="btn btn-primary" data-i18n="login_btn"></button>
                </form>
            </div>
        </div>
    <?php else : ?>
        <div class="welcomeMessage">
            <p>
                <span data-i18n="welcome_message"></span>
                <?php echo $_SESSION['user']['email']; ?>,
                <a href="index.php" data-i18n="welcome_back_home"></a>
            </p>
        </div>
    <?php endif; ?>

    <?php if (!empty($succesMessage)) : ?>
        <div class="successMessage">
            <h3 data-i18n="congrats"></h3>
            <?= htmlspecialchars($succesMessage) ?>
        </div>
    <?php endif ?>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('common/layout.php') ?>
