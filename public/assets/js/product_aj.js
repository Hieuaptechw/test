$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(document).ready(function() {
    // Xử lý ảnh đơn
    $('#file').on('change', function() {
        var file = $('#file')[0].files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#input-file-img').html('<img src="' + e.target.result + '" alt="Product Avatar" style="max-width: 100%; height: auto;">');
            };
            reader.readAsDataURL(file);
        }
    });

    // Xử lý nhiều ảnh
    $('#files').on('change', function() {
        var files = $('#files')[0].files;
        $('#input-file-imgs').html('');
        if (files.length > 0) {
            for (let i = 0; i < files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#input-file-imgs').append('<img src="' + e.target.result + '" alt="Product Image" style="max-width: 100%; height: auto;">');
                };
                reader.readAsDataURL(files[i]);
            }
        }
    });
});
