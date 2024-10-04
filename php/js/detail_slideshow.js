"use strict";

const img = document.querySelectorAll("#Slideshow img");
const btn = document.querySelectorAll("#SlideBtn button");

let cnt = 0;

// フェードアニメーション
const keyframes = {
  opacity: [0, 1],
};

const options = {
  duration: 2000,
  easing: "ease",
};

const change = () => {
  for (let i = 0; i < btn.length; i++) {
    if (i === cnt) {
      img[i].classList.remove("Hidden");
      btn[i].classList.add("BtnActive");
    } else {
      img[i].classList.add("Hidden");
      btn[i].classList.remove("BtnActive");
    }
  }
  img[cnt].animate(keyframes, options);
};

const slideClick1 = () => {
  cnt = 0;
  change();
};

const slideClick2 = () => {
  cnt = 1;
  change();
};

const slideClick3 = () => {
  cnt = 2;
  change();
};

const slideAuto = () => {
  if (cnt === img.length - 1) {
    cnt = 0;
  } else {
    cnt++;
  }
  switch (cnt) {
    case 0:
      slideClick1();
      break;

    case 1:
      slideClick2();
      break;

    case 2:
      slideClick3();
      break;
  }
};

setInterval(slideAuto, 5000);
btn[0].addEventListener("click", slideClick1);
btn[1].addEventListener("click", slideClick2);
btn[2].addEventListener("click", slideClick3);
