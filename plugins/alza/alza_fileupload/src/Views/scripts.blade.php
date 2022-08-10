<script src="{{ asset('vendor/jquery-file-upload/jquery.uploadfile.min.js') }}"></script>
<script>
    $(document).ready(function() {
        var lsfile_upload = [];
        var maxUpload = parseInt("{{ $max }}");
        var multiUpload = true;
        var sizeUpload = parseInt("{{ $size }}");
        var allowUpload = "{{ $allow }}";
        $("#fileuploader").uploadFile({
            url: "{{ route('fileupload.upload') }}",
            formData: {
                _token: "{{ csrf_token() }}",
            },
            method: "POST",
            enctype: "multipart/form-data",
            dragDrop: true,
            maxFileCount: maxUpload,
            multiple: multiUpload,
            fileName: "filenames",
            maxFileSize: sizeUpload * 1024,
            allowedTypes: allowUpload,
            returnType: "json",
            showDone: false,
            showDelete: true,
            onSuccess: function(files, response, xhr, pd) {
                console.log($.isEmptyObject(response[0].filename));
                if ($.isEmptyObject(response[0].filename)) {
                    $(".toast.bg-danger").toast("show");
                    printErrorMsg(response[0]['message']);
                } else {
                    $(".toast.bg-success").toast("show");
                    printSuccessMsg(response[0]['message']);
                }
                $.each(response[0], function(index, value) {
                    if (index == 'filename') {
                        lsfile_upload.push(value);
                    }
                });
                const datax = lsfile_upload.join(",");
                $("#image").val(datax);
            },
            onError: function(files, status, message, pd) {},
            deleteCallback: function(data, pd) {
                for (var i = 0; i < data.length; i++) {
                    $.post("{{ url('/fileupload/unupload') }}", {
                            filename: data[i]['filename'],
                        },
                        function(resp, textStatus, jqXHR) {
                            lsfile_upload = lsfile_upload.filter(function(item) {
                                return item !== resp
                            })
                            const vfile = lsfile_upload.join(",")
                            $("#image").val(vfile);
                        });

                }
                pd.statusbar.hide();
            },
            dragDropStr: "<span><b>Drag &amp; Drop Files</b></span>",
            abortStr: "Abort",
            multiDragErrorStr: "Multiple File Drag &amp; Drop is not allowed.",
            extErrorStr: "extensi file tidak diizinkan, extensi diizinkan: ",
            sizeErrorStr: "ukuran file tidak diizinkan, ukuran diizinkan: ",
            uploadErrorStr: "Upload is not allowed",
            maxFileCountErrorStr: "Maximum files diupload: ",
            dragdropWidth: 'auto'
        });
    });

    function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'block');
        if (typeof msg == "object") {
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        } else {
            $(".print-error-msg").find("ul").append('<li>' + msg + '</li>');
        }

    }

    function printSuccessMsg(msg) {
        $(".print-success-msg").find("ul").html('');
        $(".print-success-msg").css('display', 'block');
        if (typeof msg == "object") {
            $.each(msg, function(key, value) {
                $(".print-success-msg").find("ul").append('<li>' + value + '</li>');
            });
        } else {
            $(".print-success-msg").find("ul").append('<li>' + msg + '</li>');
        }
    }

    function removeItem(arr, item) {
        return arr.filter(f => f !== item)
    }

    function del_img(file) {
        const rm = '';
        const data = $("#image").val();
        const arr = data.split(',');
        const newdata = removeItem(arr, file.name);
        var input = $("#rm_image")
        input.val(input.val() + file.name + ',').slice(0, -1);
        $("#image").val(newdata);
        $("#col" + file.id).remove();
    }
</script>
