searchForm = document.querySelector('.search-form');

document.querySelector('#search-btn').onclick = () =>{
    searchForm.classList.toggle('active');
}

let loginForm = document.querySelector('.login-form-container');

document.querySelector('#login-btn').onclick = () =>{
    loginForm.classList.toggle('active');
}

document.querySelector('#close-login-btn').onclick = () =>{
    loginForm.classList.remove('active');
}

let cart = document.querySelector('.cart');
let cartfield = document.querySelector('.cart-field');
let add = document.getElementsByClassName('add');


for(let but of add){
  but.onclick = e=>{
       let item = Number(cart.getAttribute('data-count') || 0);
       cart.setAttribute('data-count', item + 1);
       cart.classList.add('on');

      // image animated to cart
      let parent = e.target.parentNode.parentNode.parentNode;
      let image = parent.querySelector('img');
      let span = document.createElement('span');
      span.className = 'image-carior';
      parent.insertBefore(span, parent.lastElementChild);

      let s_image = image.cloneNode(false);
      span.appendChild(s_image);
      span.classList.add('active');
      setTimeout(()=>{
        span.classList.remove('active');
        span.removeChild(s_image);
      },500);

      //copy and paste
      let clone = parent.cloneNode(true);
      clone.querySelector('.add').style.display = "none";
      clone.querySelector('.add').removeAttribute('class');
      cartfield.appendChild(clone);

      if (clone) {
        cart.onclick = ()=>{
          cartfield.classList.toggle('display');
        }
      }
  }
}




window.onscroll = () =>{

    searchForm.classList.remove('active');

    if(window.scrollY > 80){
        document.querySelector('.header .header-2').classList.add('active');
    }else{
        document.querySelector('.header .header-2').classList.remove('active');
    }
}

window.onload = () =>{

    if(window.scrollY > 80){
        document.querySelector('.header .header-2').classList.add('active');
    }else{
        document.querySelector('.header .header-2').classList.remove('active');
    }
    fadeOut();
}

function loader(){
  document.querySelector('.loader-container').classList.add('active');
}

function fadeOut(){
  setTimeout(loader, 4000);
}

var swiper = new Swiper(".books-slider", {
   loop:true,
   centeredSlides: true,
   autoplay: {
       delay: 9500,
       disableOnInteraction: false,
   },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
    },
  });

  
   var swiper = new Swiper(".arrivals-slider", {
    spaceBetween: 10,
    loop:true,
    centeredSlides: true,
    autoplay: {
        delay: 9500,
        disableOnInteraction: false,
    },
     breakpoints: {
       0: {
         slidesPerView: 1,
       },
       768: {
         slidesPerView: 2,
       },
       1024: {
         slidesPerView: 3,
       },
     },
   });

   var swiper = new Swiper(".reviews-slider", {
    spaceBetween: 10,
    grabCursor:true,
    loop:true,
    centeredSlides: true,
    autoplay: {
        delay: 9500,
        disableOnInteraction: false,
    },
     breakpoints: {
       0: {
         slidesPerView: 1,
       },
       768: {
         slidesPerView: 2,
       },
       1024: {
         slidesPerView: 3,
       },
     },
   });


   var swiper = new Swiper(".blogs-slider", {
    spaceBetween: 10,
    grabCursor:true,
    loop:true,
    centeredSlides: true,
    autoplay: {
        delay: 9500,
        disableOnInteraction: false,
    },
     breakpoints: {
       0: {
         slidesPerView: 1,
       },
       768: {
         slidesPerView: 2,
       },
       1024: {
         slidesPerView: 3,
       },
     },
   });