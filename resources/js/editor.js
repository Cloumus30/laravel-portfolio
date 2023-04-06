const quill = new Quill('#editor', {
    theme: 'snow'
});
let quillVal = null;

quill.on('text-change', function(delta, oldDelta, source) {
    quillVal = quill.root.innerHTML
  });
  
const toolbar = document.getElementsByClassName('ql-toolbar');
toolbar[0].classList.remove('ql-snow');
toolbar[0].classList.add('ql-bubble');

 