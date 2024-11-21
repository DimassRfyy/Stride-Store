// accordion's open and close feature handled by tailwind
// this script only for height animation
document.addEventListener("DOMContentLoaded", function() {
    const accordions = document.querySelectorAll('.accordion');
    
    accordions.forEach(accordion => {
        const height = accordion.scrollHeight; 
        accordion.style.height = `${height}px`; 
    });
});