import 'bootstrap/js/dist/alert'
import 'bootstrap/js/dist/button'
import 'bootstrap/js/dist/carousel'
import 'bootstrap/js/dist/collapse'
import 'bootstrap/js/dist/dropdown'
// import 'bootstrap/js/dist/modal'
// import 'bootstrap/js/dist/offcanvas'
// import 'bootstrap/js/dist/popover'
// import 'bootstrap/js/dist/scrollspy'
import 'bootstrap/js/dist/tab'
// import 'bootstrap/js/dist/toast'
// import 'bootstrap/js/dist/tooltip'
import '../../../../styles/front/pages/home/index.scss'

require('animate.css/animate.css')

// animate on scroll
const fadeInRightAnimations = document.querySelectorAll('.element-to-fadeInRight');
const fadeInAnimations = document.querySelectorAll('.element-to-fadeIn');

function checkIfInView() {
    const windowHeight = window.innerHeight;
    const windowTopPosition = window.scrollY;
    const windowBottomPosition = (windowTopPosition + windowHeight);

    fadeInRightAnimations.forEach(el => {
        const elementHeight = el.offsetHeight;
        const elementTopPosition = el.offsetTop;
        const elementBottomPosition = (elementTopPosition + elementHeight);

        // check if this current element is within viewport
        if ((elementBottomPosition >= windowTopPosition) &&
            (elementTopPosition <= windowBottomPosition)) {
            el.classList.add('animate__fadeInRight');
        }
    });
    fadeInAnimations.forEach(el => {
        const elementHeight = el.offsetHeight;
        const elementTopPosition = el.offsetTop;
        const elementBottomPosition = (elementTopPosition + elementHeight);

        // check if this current element is within viewport
        if ((elementBottomPosition >= windowTopPosition) &&
            (elementTopPosition <= windowBottomPosition)) {
            el.classList.add('animate__fadeIn');
        }
    });
}

/* const animate = document.querySelectorAll('[class*=animate__]');
console.log(animate);

function checkIfInView() {
    const windowHeight = window.innerHeight;
    const windowTopPosition = window.scrollY;
    const windowBottomPosition = (windowTopPosition + windowHeight);

    animate.forEach(el => {
        let className = el.getElementsByClassName();
        console.log(className)

        const elementHeight = el.offsetHeight;
        const elementTopPosition = el.offsetTop;
        const elementBottomPosition = (elementTopPosition + elementHeight);

        // check if this current element is within viewport
        if ((elementBottomPosition >= windowTopPosition) &&
            (elementTopPosition <= windowBottomPosition)) {
            el.classList.add('animate__fadeInUp');
        }
    });
} */

window.addEventListener('scroll', checkIfInView);