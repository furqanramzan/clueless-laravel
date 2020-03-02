// //Main navigation scroll spy for shadow
// $(window).scroll(function () {
//     var y = $(window).scrollTop();
//     if (y > 0) {
//         $("#header").addClass('--not-top');
//     } else {
//         $("#header").removeClass('--not-top');
//     }
// });
$(window).scroll(function () {
    if ($(window).scrollTop() > 10) {
        $('#header').addClass('floatingNav');
    } else {
        $('#header').removeClass('floatingNav');
    }
});


$(document).ready(function () {
    $("form").submit(function (event) {
        event.preventDefault();
        $(':input[type="submit"]').prop('disabled', true);
        var inputs = {};
        $.each($('form').serializeArray(), function (i, field) {
            inputs[field.name] = field.value;
        });
        console.log(inputs);
        var data = {
            _token: inputs._token,
            name: inputs.name,
            body: inputs.body,
        };


        $.post("/comment/" + inputs.review, data,
            function (data, status) {
                if (status === 'success') {
                    var comment = '<div class="comment-wrap"><div class="comment-block"><h4 class="mb-0">'+data.name+'</h4><p class="comment-text">' + data.body + '     </p><div class="bottom-comment"><div class="comment-date float-right">' + data.date + '</div></div></div></div>';
                    $("#comments_list").prepend(comment);
                    $(':input[type="submit"]').prop('disabled', false);
                } else {
                    alert('An error occured. Please refresh page and try again');
                }
            });
    });
});