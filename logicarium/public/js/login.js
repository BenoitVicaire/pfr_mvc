export function initLogin(){
    const buttons=document.querySelectorAll('.tabBtn');
    const contents=document.querySelectorAll('.tabContent');

    buttons.forEach(button=>{
        
        button.addEventListener('click', ()=>{
            buttons.forEach(btn=>btn.classList.remove('active'));
            contents.forEach(content=>content.classList.remove('active'));

            button.classList.add('active');
            document.getElementById(button.dataset.tab).classList.add('active');
        });
    });

    const urlParams = new URLSearchParams(window.location.search);
    const tabFromUrl = urlParams.get('tab');
    if(tabFromUrl){
        buttons.forEach(btn=>btn.classList.remove('active'));
        contents.forEach(content=>content.classList.remove('active'));

        const buttonToActivate = Array.from(buttons).find(
            b=>b.dataset.tab.toLowerCase()===tabFromUrl.toLowerCase()
        );
        
       if(buttonToActivate) {
        buttonToActivate.classList.add('active');
        const content = document.getElementById(buttonToActivate.dataset.tab);
        if(content) content.classList.add('active');
       }
    }
};
