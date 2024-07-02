/*!
* Start Bootstrap - Clean Blog v6.0.9 (https://startbootstrap.com/theme/clean-blog)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-clean-blog/blob/master/LICENSE)
*/
window.addEventListener('DOMContentLoaded', () => {
    let scrollPos = 0;
    const mainNav = document.getElementById('mainNav');
    const headerHeight = mainNav.clientHeight;
    window.addEventListener('scroll', function() {
        const currentTop = document.body.getBoundingClientRect().top * -1;
        if ( currentTop < scrollPos) {
            // Scrolling Up
            if (currentTop > 0 && mainNav.classList.contains('is-fixed')) {
                mainNav.classList.add('is-visible');
            } else {
                console.log(123);
                mainNav.classList.remove('is-visible', 'is-fixed');
            }
        } else {
            // Scrolling Down
            mainNav.classList.remove(['is-visible']);
            if (currentTop > headerHeight && !mainNav.classList.contains('is-fixed')) {
                mainNav.classList.add('is-fixed');
            }
        }
        scrollPos = currentTop;
    });
})

document.addEventListener('DOMContentLoaded', function () {
    var reviewCards = document.querySelectorAll('.review-card');

    reviewCards.forEach(function (card) {
        card.addEventListener('mouseenter', function () {
            // 鼠標進入時將區域的max-height設定為一個足夠大的值以展開內容
            card.style.maxHeight = '1000px'; // 可以根據實際內容高度調整
        });

        card.addEventListener('mouseleave', function () {
            // 鼠標離開時恢復最大高度
            card.style.maxHeight = '100px'; // 與上面的CSS中的初始最大高度相同
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var reviewCards = document.querySelectorAll('.review-card');

    reviewCards.forEach(function (card) {
        card.addEventListener('mouseenter', function () {
            // 鼠标进入时显示详细信息
            card.querySelectorAll('.hidden-details').forEach(function(detail) {
                detail.style.display = 'block';
            });
        });

        card.addEventListener('mouseleave', function () {
            // 鼠标离开时隐藏详细信息
            card.querySelectorAll('.hidden-details').forEach(function(detail) {
                detail.style.display = 'none';
            });
        });
    });
});