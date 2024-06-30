// modal scroll 
function openModal() {
  document.addEventListener('scroll', preventScroll);
}

function closeModal() {
  document.removeEventListener('scroll', preventScroll);
}


function preventScroll(event) {
  event.preventDefault();
}

// Navbar 
window.addEventListener('scroll', function() {
  var navbar = document.querySelector('.fixed-top');
  var container = document.querySelector('#containerToShowOnScroll');
  navbar.classList.toggle('scrolled', window.scrollY > 50);
  if (window.scrollY > 100) {
    container.classList.remove('d-none');
  } else {
    container.classList.add('d-none');
  }
});



  //  Initiate glightbox
  // const glightbox = GLightbox({
  //   selector: ".glightbox",
  // });


// Toggle password 
document.addEventListener("DOMContentLoaded", function () {
  var togglePasswordElements = document.querySelectorAll(".toggle-password");

  togglePasswordElements.forEach(function (togglePasswordElement) {
      togglePasswordElement.addEventListener("click", function () {
          // Toggle the icon classes
          togglePasswordElement.classList.toggle("fa-eye");
          togglePasswordElement.classList.toggle("fa-eye-slash");

          // Find the associated input field
          var input = togglePasswordElement.parentElement.querySelector("input");

          // Toggle the input field type between password and text
          if (input.type === "password") {
              input.type = "text";
          } else {
              input.type = "password";
          }
      });
  });
});


// يتم استدعاء الدالة عندما يتم تحميل المحتوى الرئيسي للصفحة
document.addEventListener("DOMContentLoaded", function() {

  // // يتم البحث عن جميع العناصر التي تحتوي على فئة "heartIcon" وتخزينها في متغير
  // const heartIcons = document.querySelectorAll('.heartIcon');
  //
  // // دالة لمحاكاة عملية التحميل
  // function simulateLoading(heartIcon, callback) {
  //   // تضاف فئة "loading" لتمثيل حالة التحميل
  //   heartIcon.classList.add('loading');
  //   // يتم إزالة فئة "loading" بعد مرور ثانية واحدة
  //   setTimeout(function() {
  //     heartIcon.classList.remove('loading');
  //     // إذا كانت هناك دالة callback، يتم استدعاؤها بعد انتهاء التحميل
  //     if (callback) {
  //       callback();
  //     }
  //   }, 1000);
  // }
  //
  // // دالة للتعامل مع نقرة المستخدم على أيقونة القلب
  // function handleHeartClick(event) {
  //   // يمنع السلوك الافتراضي للرابط
  //   event.preventDefault();
  //   // يتم تخزين العنصر المستهدف (أيقونة القلب) في متغير
  //   const heartIcon = this;
  //   // يتم تبديل فئة "text-danger" لتغيير لون القلب
  //   heartIcon.classList.toggle('text-danger');
  //   // يتم استدعاء دالة محاكاة التحميل
  //   simulateLoading(heartIcon, function() {
  //     // بعد انتهاء التحميل، يتم إخفاء أيقونة القلب الحالية
  //     heartIcon.style.display = 'none';
  //     // يتم إنشاء أيقونة قلب جديدة وإضافتها إلى العنصر الأب
  //     const newHeartIcon = document.createElement('i');
  //     newHeartIcon.classList.add('fa-solid', 'fa-heart', 'position-absolute', 'heartIcon');
  //     newHeartIcon.style.right = '0';
  //     newHeartIcon.style.top = '0';
  //     heartIcon.parentNode.appendChild(newHeartIcon);
  //     // يتم عرض رسالة تنبيه للمستخدم
  //     alert('Product Added');
  //     // يتم تغيير لون القلب الجديد من الأحمر إلى الأزرق
  //     newHeartIcon.classList.remove('text-danger');
  //     newHeartIcon.classList.add('text-info');
  //   });
  // }
  //
  // // يتم ربط دالة التعامل مع نقرة المستخدم بكل أيقونة قلب في الصفحة
  // heartIcons.forEach(function(heartIcon) {
  //   heartIcon.addEventListener('click', handleHeartClick);
  // });



});

  
