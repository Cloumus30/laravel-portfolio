// Quill Instance
const quill = new Quill('#editor', {
    theme: 'snow'
});
let quillVal = null;

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
function submitFormPorto(){
  event.preventDefault()
  const formPorto = document.getElementById('form-porto');
  const title = document.getElementById('app-name');
  const photo = document.getElementById('photo').files[0];
  const form = new FormData(formPorto);
  form.append('description', quillVal);
  
  axios.post('/form-submit',form)
  .then((res)=>{
    window.location.href = '/'
  })
  .catch((err) => {
    console.log(err);
    alert(err);
  });
}

/**
 * Preview Image When Uploaded Image
 */
function previewImage(){
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

 