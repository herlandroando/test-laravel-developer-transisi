
$(function () {

    var $modal = $('#modal_crop');
    var image = document.getElementById('image');
    var ajax_url = "";
    var cropper;
    $("#create_upload_logo").on("click",()=>{
        ajax_url = "create/temp"
        $("#input_logo").trigger("click");
    })
    $("#edit_upload_logo").on("click",()=>{
        ajax_url = "edit/file"
        $("#input_logo").trigger("click");
    })

    $("body").on("change", "#input_logo", function (e) {
        var files = e.target.files;
        var done = function (url) {
            image.src = url;
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;
        if (files && files.length > 0) {
            file = files[0];
            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });
    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3,
            minCropBoxWidth: 100,
            minCropBoxHeight: 100,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });
    $("#crop_accept").on("click", function () {
        canvas = cropper.getCroppedCanvas({
            minWidth: 100,
            minHeight: 100,
        });
        canvas.toBlob(function (blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function () {
                var base64data = reader.result;
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: ajax_url,
                    data: { 'logo': base64data },
                    success: function (data) {
                        console.log(data);
                        $modal.modal('hide');
                        if (data.success) {
                            alert(data.message);
                            $("#filename").text(data.value.filename)
                            $("#fileurl").prop("href",data.value.fileurl)
                        }
                    }
                });
            }
        });
    })
})
