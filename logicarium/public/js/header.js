export function initLangMenu() {
    const toggle = document.getElementById('langToggle');
    const menu = document.getElementById('langMenu');
    const currentLang = document.getElementById('currentLang');

    if (!toggle || !menu || !currentLang) return;

    function updateCurrentLang() {
        const activeBtn = menu.querySelector('button.active');
        if (!activeBtn) return;

        const flagClass = [...activeBtn.classList]
            .find(cls => cls.startsWith('fi-'));

        currentLang.className = '';
        currentLang.classList.add('fi', flagClass);
    }

    // toggle menu
    toggle.addEventListener('click', (e) => {
        e.stopPropagation();
        const isOpen = menu.classList.toggle('open');
        toggle.setAttribute('aria-expanded', isOpen);
    });
    // click sur une langue
    menu.querySelectorAll('button').forEach(btn => {
        btn.addEventListener('click', () => {
            menu.querySelectorAll('button')
                .forEach(b => b.classList.remove('active'));

            btn.classList.add('active');
            updateCurrentLang();

            menu.classList.remove('open');
            toggle.setAttribute('aria-expanded', 'false');
        });
    });

    // clic extérieur
    document.addEventListener('click', () => {
        menu.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
    });

    // init au chargement
    updateCurrentLang();
}

export function initUserMenu(){
    const toggle=document.getElementById('menuToggle');
    const menu=document.getElementById('userMenu');

    toggle.addEventListener('click', (e) =>{
        const isOpen = menu.classList.toggle('open');
        toggle.setAttribute('aria-expanded', isOpen);
    })
    menu.querySelectorAll('button')
}