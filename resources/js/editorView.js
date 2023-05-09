
// Quill Instance
const quill = new Quill('#editor-view', {
    theme: 'bubble'
});

// Update Style quill editor
const toolbar = document.getElementsByClassName('ql-toolbar');
toolbar[0].classList.remove('ql-snow');
toolbar[0].classList.add('ql-bubble');

quill.disable()