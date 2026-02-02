// import { setLanguage } from './langue.js'
import { initAvatar } from "./avatar.js";
import { category } from "./forum.js";
import { initLangue, setLanguage } from "./langue.js";
import { initLogin } from "./login.js";


document.addEventListener("DOMContentLoaded", () => {
// Langue active : 
    initLangue();
    const flags = document.querySelectorAll(".flags button");

    flags.forEach(btn => {
        btn.addEventListener("click", ()=>{
            flags.forEach(flag=>flag.classList.remove("active"));
            btn.classList.add("active");
        });
    });

    // Change la langue au clic :
    document.getElementById("flag_fr").addEventListener("click", () => {
        setLanguage("fr");
    });
    document.getElementById("flag_gb").addEventListener("click", () => setLanguage("gb"));

    initAvatar();
 
    if (document.body.dataset.page === 'forum') {
        document.body.classList.add('page-forum');
        category();
    }
    

    if (document.body.dataset.page === 'login') {
        document.body.classList.add('page-login');
        initLogin();
    }
    if (document.body.dataset.page === 'thread') {
        document.body.classList.add('page-thread');
    }
});

