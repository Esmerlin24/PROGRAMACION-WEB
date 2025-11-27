// Menú 
const btn = document.getElementById('btn-hamburger');
const nav = document.getElementById('main-nav');
btn.addEventListener('click',()=>{
    const ul = nav.querySelector('ul');
    ul.style.display = (ul.style.display==='flex') ? 'none':'flex';
});

// Carrusel
const slides = document.querySelectorAll('.slide');
const dotsContainer = document.querySelector('.dots');
let current = 0;

// Crear puntitos
slides.forEach((s,i)=>{
    const dot = document.createElement('button');
    if(i===0) dot.classList.add('active');
    dot.addEventListener('click',()=>goTo(i));
    dotsContainer.appendChild(dot);
});
const dots = dotsContainer.querySelectorAll('button');

function update(){
    document.querySelector('.slides').style.transform = `translateX(${-current*100}%)`;
    dots.forEach((d,i)=>d.classList.toggle('active',i===current));
}
function next(){ current=(current+1)%slides.length; update();}
function prev(){ current=(current-1+slides.length)%slides.length; update();}
function goTo(i){current=i;update();}

// Flechas
document.querySelector('.next').addEventListener('click',next);
document.querySelector('.prev').addEventListener('click',prev);

// Auto-play
let autoplay = setInterval(next,4000);
const slideshowEl = document.querySelector('.slideshow');
slideshowEl.addEventListener('mouseenter',()=>clearInterval(autoplay));
slideshowEl.addEventListener('mouseleave',()=>autoplay=setInterval(next,4000));

