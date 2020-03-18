const navSlide = () => {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav_categorie');
    const navLinks = document.querySelectorAll('.nav_categorie li');

//Toggle nav
    burger.addEventListener('click', () => {
        nav.classList.toggle('nav-active');
    
    //animate links
    navLinks.forEach((link, index) => {
        if (link.style.animation) {
            link.style.animation = "";
        }else{
        link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.6}s`;
        }
    });
    //burger toggle
    burger.classList.toggle('toggle');
});
}
console.log("okay")
navSlide();