export function category(){
    document.querySelectorAll('.category-title').forEach(title=>{
    title.addEventListener('click', ()=>{
        const collapsible = title.closest('.collapsible');
        collapsible.classList.toggle('open');
    });
});
}
