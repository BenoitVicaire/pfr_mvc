export function initAvatar() {
    const switchBtn = document.getElementById("switch_btn");
    const modal = document.getElementById("profil_modal");
    const closeBtn = modal.querySelector(".close");
    const profilePic = document.getElementById("profil_pic");
    const avatarOptions = document.querySelectorAll(".avatar_option");

    // Ouvrir la modale
    switchBtn.addEventListener("click", () => {
        modal.style.display = "block";
    });
    // Fermer la modale a la croix
    closeBtn.addEventListener("click", () => {
        modal.style.display = "none";
    });
    // Fermer la modale au clic en dehors du cadre
    window.addEventListener("click", (e) => {
        if (!modal.contains(e.target) && e.target !== switchBtn) {
            modal.style.display = "none";
        }
    });
    // changer d'avatar
    avatarOptions.forEach(avatar => {
        avatar.addEventListener("click", () => {
            console.log("on click",profilePic);
            if (profilePic) {         // <- vérification
                console.log("arewein?")
                profilePic.src = avatar.src;
                modal.style.display = "none"; // fermer la modale
            }
        });
    });
}