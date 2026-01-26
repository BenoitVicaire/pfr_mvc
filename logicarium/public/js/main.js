// import { setLanguage } from './langue.js'
// import './avatar.js'
import { initAvatar } from "./avatar.js";

document.addEventListener("DOMContentLoaded", () => {
// Langue active : 
    const flags = document.querySelectorAll(".flags button");

    flags.forEach(btn => {
        btn.addEventListener("click", ()=>{
            console.log("zugzug")
            flags.forEach(flag=>flag.classList.remove("active"));
            btn.classList.add("active");
        });
    });

    // Change la langue au clic :
    document.getElementById("flag_fr").addEventListener("click", () => setLanguage("fr"));
    document.getElementById("flag_gb").addEventListener("click", () => setLanguage("gb"));

    initAvatar();
});