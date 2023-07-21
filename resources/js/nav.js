window.toggleNavside = function(){
    const navside = document.getElementById('navside');
    navside.classList.toggle('hidden');
}

// Check Locale
const locale = new URLSearchParams(window.location.search).get('locale') || null;
const activetab = 'inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500';

if(document.getElementById('tab-local-id')){
    switch (locale) {
        case 'id':
            document.getElementById('tab-local-id').className = activetab;
            break;
        
        case 'en':
            document.getElementById('tab-local-en').className = activetab;
            break;
    
        default:
            document.getElementById('tab-local-id').className = activetab;
            break;
    }
}


const nav = document.getElementById('navbar')
const navDrop = document.querySelectorAll('.nav-dropdown')

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
    Array.from(navDrop).forEach(elem => {
        elem.classList.add('bg-[#6E07F3]');
    });
}

function transparentNav(){
    nav.classList.remove('bg-[#6E07F3]');
    nav.classList.add('bg-transparent');
    nav.classList.toggle('text-[#6E07F3]');
    nav.classList.toggle('text-white');
    Array.from(navDrop).forEach(elem => {
        elem.classList.remove('bg-[#6E07F3]');
    });
}
