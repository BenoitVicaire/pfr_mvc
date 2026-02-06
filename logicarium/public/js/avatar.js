export function initAvatar() {
    const switchBtn = document.getElementById("switch_btn");
    const modal = document.getElementById("profil_modal");

    if (!switchBtn || !modal) {
        return;
    }
    const closeBtn = modal.querySelector(".close");
    const profilePic = document.getElementById("profil_pic");
    const avatarOptions = document.querySelectorAll(".avatar_option");

   // Ouvrir la modale
    switchBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        modal.style.display = "block";
    });
    // Fermer la modale a la croix
        closeBtn.addEventListener("click", () => {
            modal.style.display = "none";
        });
    // Fermer au clic extérieur
    window.addEventListener("click", (e) => {
        if (
            !modal.contains(e.target) &&
            !switchBtn.contains(e.target)
        ) {
            modal.style.display = "none";
        }
    });

    // changer d'avatar
    avatarOptions.forEach(avatar => {
        const avatarId=avatar.dataset.avatarID;
        avatar.addEventListener("click", () => {
            if (profilePic) {         // <- vérification
                profilePic.src = avatar.src;
                
            }
            fetch("/index.php?action=updateAvatar", {
                method: "POST",
                headers:{
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    avatar_id: avatarId
                })
            })
            modal.style.display = "none"; // fermer la modale
        });
    });
}