document.addEventListener("DOMContentLoaded",()=>{
 const body=document.body, toggle=document.getElementById("themeToggle");
 const saved=localStorage.getItem("gmet-theme");
 if(saved==="dark") body.classList.add("dark");
 const sync=()=>{if(toggle) toggle.textContent=body.classList.contains("dark")?"☀":"☾"}; sync();
 if(toggle) toggle.addEventListener("click",()=>{body.classList.toggle("dark");localStorage.setItem("gmet-theme",body.classList.contains("dark")?"dark":"light");sync()});
 const nav=document.querySelector(".site-nav"); const onScroll=()=>nav&&nav.classList.toggle("scrolled",window.scrollY>20); onScroll(); window.addEventListener("scroll",onScroll,{passive:true});
 const els=document.querySelectorAll(".reveal"); const io=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting){e.target.classList.add("show");io.unobserve(e.target)}}),{threshold:.12}); els.forEach(e=>io.observe(e));
 document.querySelectorAll(".navbar-collapse .nav-link").forEach(a=>a.addEventListener("click",()=>{const c=document.querySelector(".navbar-collapse"); if(c&&c.classList.contains("show")){const b=document.querySelector(".navbar-toggler"); if(b) b.click()}}));
});
