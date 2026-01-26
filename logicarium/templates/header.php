<?php 
ob_start(); 

$loggedState=false;
if($_SESSION['LOGGED_USER']){$loggedState=true;} ?>

<link rel="stylesheet" href="../public/assets/icons/flag-icons.css">
<header>
    <div class="header_top">
        <div class="header_top_left">
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
            <div class="header_top_left_right">
                <?php if(isset($_SESSION['LOGGED_USER'])){?>                   
                <a href="index.php?action=myProfil">my profil</a>
                <a href="index.php?action=login">Logout</a>
                <?php }else{?>
                    <a href="index.php?action=login">Login</a>
                <?php } ?>
                <button class="messages">Messages</button>
            </div>
        </div>
        <div class="header_middle_logo">
            <img src="assets/images/logos/Logicarium_v2.png" alt="Logo logicarium">
        </div>
        <div class="header_top_right">
            <div class="langue">
                <span id="language">Langue</span>
                <div class="flags">
                    <button class="fi fi-gb active" id="flag_gb" aria-label="English"></button>
                    <button class="fi fi-fr" id="flag_fr"aria-label="French"></button>
                </div>
            </div>
        </div>
    </div>
    <nav>
        <a href="pages/forum.html" id="forum">Forum</a>
        <a href="pages/protect_the_dungeon.html" id="ptd">Protect the dungeon</a>
        <a href="pages/contact.html" id="contact">Contact</a>
    </nav>
</header>

<?php $header = ob_get_clean(); ?>

