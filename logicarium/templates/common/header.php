<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ob_start(); 
require('breadCrumb.php');
$loggedState=false;
if(isset($_SESSION['logged']) && $_SESSION['logged']){$loggedState=true;} ?>

<link rel="stylesheet" href="../public/assets/icons/flag-icons.css">
<header class="commonHeader">
    <div class="header_top">
        <div class="header_top_left">
            <!-- Image de profil -->
            <div class="header_top_left_left">
                <img src="assets/images/avatar/avatar_1.png" alt="Profil_picture" id="profil_pic">
                <button class="switch_picture" id="switch_btn">Avatar</button> 

                <div class="modal" id="profil_modal">
                    <div class="modal_content">
                        <span class="close">&times;</span>
                        <h3>Change Avatar</h3>
                        <div class="avatars">
                            <img src="assets/images/avatar/avatar_1.png" alt="Trickster avatar" class="avatar_option">
                            <img src="assets/images/avatar/avatar_2.png" alt="Witch avatar" class="avatar_option">
                            <img src="assets/images/avatar/avatar_3.png" alt="Chieftain avatar" class="avatar_option">
                        </div>
                    </div>
                </div>
            </div>
            <!-- connexion profil messages -->
            <div class="header_top_left_right">
                <?php if(isset($_SESSION['logged'])){?>                   
                    <a href="index.php?action=myProfil" data-i18n="profil"></a>
                    <a href="index.php?action=logout"data-i18n="logout"></a>
                <?php }else{?>
                    <a id="loginLink" href="index.php?action=login&tab=connexion"data-i18n="login"></a>
                <?php } ?>
                <a href="index.php?action=messages"data-i18n="messages"></a>
            </div>
        </div>
        <div class="header_middle_logo">
            <img src="assets/images/logos/Logicarium_v2.png" alt="Logo logicarium">
        </div>
        <!-- Langues -->
        <div class="header_top_right">
            <div class="langue">
                <button
                    class="langue_toggle"
                    id="langToggle"
                    aria-expanded="false"
                    aria-haspopup="listbox"
                >
                    <span id="currentLang"></span>
                </button> 
                <span id="language" data-i18n="language"></span>
                    <div class="flags" id="langMenu">
                        <button class="fi fi-gb active" id="flag_gb" aria-label="English"></button>
                        <button class="fi fi-fr" id="flag_fr"aria-label="French"></button>
                    </div>
            </div>
        </div>
    </div>
    <!-- Navbar -->
    <nav class="mainNav">
        <a href="index.php?action=forum" id="forum">Forum</a>
        <a href="index.php" id="ptd">Accueil</a>
        <a href="index.php?action=contact" id="contact">Contact</a>
    </nav>
    <?php if(isset($breadcrumb) && $breadcrumb===true) : ?>
         <?= $breadCrumbDisplay ?>
    <?php endif ?>
</header>

<?php $header = ob_get_clean(); ?>

