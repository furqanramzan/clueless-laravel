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
