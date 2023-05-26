window.toggleNavside = function(){
    const navside = document.getElementById('navside');
    navside.classList.toggle('hidden');
}

const nav = document.getElementById('navbar')
let isNavColor = false;
let scrollY = window.scrollY;
if(scrollY > 100){
    if(!isNavColor){
        colorNav()
        isNavColor = true;
    }
}else{
    if(isNavColor){
        transparentNav()
        isNavColor = false;
    }
}
addEventListener('scroll',(e) =>{
    scrollY = window.scrollY;
    if(scrollY > 100){
        if(!isNavColor){
            colorNav()
            isNavColor = true;
        }
    }else{
        if(isNavColor){
            transparentNav()
            isNavColor = false;
        }
    }
})

function colorNav(){
    nav.classList.remove('bg-transparent');
    nav.classList.add('bg-[#6E07F3]');
    nav.classList.toggle('text-[#6E07F3]');
    nav.classList.toggle('text-white');
}

function transparentNav(){
    nav.classList.remove('bg-[#6E07F3]');
    nav.classList.add('bg-transparent');
    nav.classList.toggle('text-[#6E07F3]');
    nav.classList.toggle('text-white');
}
