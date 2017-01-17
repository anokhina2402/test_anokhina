$("#file").fileinput({
    'allowedFileExtensions': ['jpg', 'png', 'gif'],
});

$(document).ready(function () {
    $('#loginForm').validate({
        rules: {
            login: {
                required: true,
                required: true
            },

            password: {
                required: true,
                required: true
            },

        },
        highlight: function (element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
    });

    $('#addForm').validate({
        ignore: [],
        debug: false,
        rules: {

            comment: {
                required: function () {
                    CKEDITOR.instances.comment.updateElement();
                },

                minlength: 10
            },
            name: {
                required: true,
            },

            email: {
                required: true,
                email: true
            },

        },
        highlight: function (element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
    });


    $("#comment").ckeditor();

});
