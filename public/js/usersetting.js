document.addEventListener('livewire:initialized', function () {
    // console.log('hello')
    
    document.getElementById('profile-pic-upload').addEventListener('change', function (event) {
        if (event.target.files.length > 0) {
            let reader = new FileReader();
            reader.onload = function (e) {
                setTimeout(() => {
                    Livewire.dispatch('showCropper', e.target.result);
                }, 1000);
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    });
    
    let croppieInstance;
    
    Livewire.on('showCropper', imageUrl => {
        setTimeout(() => {
            $('#cropModal').modal('show');
            croppieInstance = new Croppie(document.getElementById('croppie-container'), {
                url: imageUrl,
                viewport: { width: 200, height: 200, type: 'square' },
                boundary: { width: 300, height: 300 },
                enforceBoundary: true
            });
        }, 500);
    });

    
    document.getElementById('crop-image-button').addEventListener('click', function () {
        croppieInstance.result({ type: 'base64', size: 'viewport' }).then(function (croppedImage) {
            Livewire.dispatch('cropImage', croppedImage);
            $('#cropModal').modal('hide');
            croppieInstance.destroy();
        });
    });

});