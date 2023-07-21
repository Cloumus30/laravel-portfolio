import './bootstrap';

import 'flowbite';
import { Dismiss } from 'flowbite';

import.meta.glob([
        '../images/**',
        '../fonts/**',
    ]);

// target element that will be dismissed
const $targetEl = document.getElementById('targetElement');

// optional trigger element
const $triggerEl = document.getElementById('triggerElement');

// options object
const options = {
  transition: 'transition-opacity',
  duration: 5000,
  timing: 'ease-out',

  // callback functions
  onHide: (context, targetEl) => {

  }
};

/*
* $targetEl: required
* $triggerEl: optional
* options: optional
*/
const dismiss = new Dismiss($targetEl, $triggerEl, options);
if($targetEl){
    dismiss.hide();
}

 
// Change To section id without change url
window.functionforscroll = function(id){
  const reqId = id;
  const el = document.getElementById(reqId);
  if(!el){
    const first = id.split('-')[0]
    window.location.href = '/'+ window.location.search;
  }
  window.scrollTo(0, document.getElementById(reqId).offsetTop-70);
}

// Change Language Query Params Url
window.changeLang = function(locale){
  window.location.href = window.location.origin + window.location.pathname + '?locale=' + locale;
}

