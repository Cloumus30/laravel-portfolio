const toolbarOptions = [
  ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
  ['blockquote', 'code-block'],

  [{ 'header': 1 }, { 'header': 2 }],               // custom button values
  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
  [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
  [{ 'direction': 'rtl' }],                         // text direction

  [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
  [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

  [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
  [{ 'font': [] }],
  [{ 'align': [] }],

  ['clean']                                         // remove formatting button
];

// Quill Instance
const quill = new Quill('#editor', {
  modules: {
    toolbar: toolbarOptions
  },
    theme: 'snow'
});
let quillVal = null;
let description = document.getElementById('description');

if(description.value){
  quillVal = description.value;
  quill.root.innerHTML = quillVal;
}

// Get Quill Editor Value as HTML
quill.on('text-change', function(delta, oldDelta, source) {
    quillVal = quill.root.innerHTML
  });
  
// Update Style quill editor
const toolbar = document.getElementsByClassName('ql-toolbar');
toolbar[0].classList.remove('ql-snow');
toolbar[0].classList.add('ql-bubble');

/**
 * Submit Form Porto
 */
window.submitFormPorto = function(){
  event.preventDefault()
  const formPorto = document.getElementById('form-porto');
  description = document.getElementById('description');
  description.value = quillVal;
  formPorto.submit();
}

/**
 * Preview Image When Uploaded Image
 */
window.previewImage = function (){
  console.log('data');
  const photo = document.getElementById('photo').files[0];
  const reader  = new FileReader();
  reader.readAsDataURL(photo);
  reader.onloadend = function(){
    const photoPreview = document.getElementById('photo-preview');
    photoPreview.classList.remove('hidden');
    photoPreview.src = reader.result;  
  }
}