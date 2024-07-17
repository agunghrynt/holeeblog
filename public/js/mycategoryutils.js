// Auto generate slug
// const catName = document.querySelector('#name');
// const slug = document.querySelector('#slug');
// catName.addEventListener('change', function(){
//     fetch('/user-dashboard/categories/checkSlug?name=' + catName.value)
//         .then(response => response.json())
//         .then(data => slug.value = data.slug) 
// });

// Disable file upload for trix editor
document.addEventListener('trix-file-accept', function(e){
    e.preventDefault();
});

// // Preview Image Upload By User
// const imageInput = document.getElementById('image');
// const imagePreview = document.getElementById('file-preview');
// function previewImageSelected()
// {
//   const file = imageInput.files[0];
//   if(file)
//   {
//     const reader = new FileReader();
//     reader.readAsDataURL(file);
//     reader.onload = function(e)
//     {
//       imagePreview.src = e.target.result;
//     }
//   }
// }

// // Showing div after user upload a image
// const show = document.getElementById('showImg');
// const divStyle = show.style.display;
// function showDiv()
// {
//   if(divStyle == 'none')
//   {
//     show.style.display = 'block';
//   }
// }

// imageInput.addEventListener('change', previewImageSelected);
// imageInput.addEventListener('change', () => {
//   previewImageSelected();
//   showDiv();
// });