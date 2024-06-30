
$(function(){
$('.attrib .option').click(function(){
$(this).siblings().removeClass('activ');
$(this).addClass('activ');
})
$('.zoomControl').click(function(){
$(this).parents('.productCard').addClass('morph');
$('body').addClass('noScroll');
})
$('.closePreview').click(function(){
$(this).parents('.productCard').removeClass('morph');
$('body').removeClass('noScroll');
})
$('.movControl').click(function(){
let imgActiv = $(this).parents('.preview').find('.imgs img.activ');
if ($(this).hasClass('left')) {
imgActiv.index() == 0 ? $('.imgs img').last().addClass('activ') : $('.imgs img.activ').prev().addClass('activ');
} else {
imgActiv.index() == ($('.imgs img').length - 1) ? $('.imgs img').first().addClass('activ') : $('.imgs img.activ').next().addClass('activ');
}
imgActiv.removeClass('activ');
})
})


const imgs = document.querySelectorAll('.img-select a');
const imgBtns = [...imgs];
let imgId = 1;

imgBtns.forEach((imgItem) => {
    imgItem.addEventListener('click', (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
    });
});

function slideImage(){
    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
}

window.addEventListener('resize', slideImage);