"use strict";

const text = document.querySelectorAll("#MainTextBox h1");

const carousel = document.querySelectorAll("#CarouselBox img");

const progress = document.querySelector("#Progress");

const btn = document.querySelectorAll("#CarouselBtn button")

let cnt = 0;

// フェードアニメーション
const keyframes = {
  opacity: [0, 1],
};

const options = {
  duration: 5000,
  easing: "ease",
};

// プログレスバーの値を加算
const increment = () => {
  progress.value += 1;
  if (progress.value === 100) {
    slideAuto();
  }
};

// テキストと画像とボタンを切り替える
const change = () => {
  for (let i = 0; i < carousel.length; i++) {
    if (i === cnt) {
      text[i].classList.remove("Hidden");
      carousel[i].classList.remove("Hidden");
      btn[i].classList.add("BtnActive")
    } else {
      text[i].classList.add("Hidden");
      carousel[i].classList.add("Hidden");
      btn[i].classList.remove("BtnActive")
    }
  }
//   text[cnt].animate(keyframes, options)
  carousel[cnt].animate(keyframes, options);
};

// テキスト・写真・ボタンを切り替える&progressのvalue値をリセット
const slideClick1 = () => {
  cnt = 0;
  progress.value = 0;
  change();
};

const slideClick2 = () => {
  cnt = 1;
  progress.value = 0;
  change();
};

const slideClick3 = () => {
  cnt = 2;
  progress.value = 0;
  change();
};

const slideClick4 = () => {
  cnt = 3;
  progress.value = 0;
  change();
};

// プログレスバーがMAXまでいったとき
const slideAuto = () => {
  if (cnt === carousel.length - 1) {
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
    case 3:
      slideClick4();
      break;
  }
};

// 50ミリ秒ごとにプログレスバーが1ずつ増える
setInterval(increment, 50);

// ボタンが押された時
btn[0].addEventListener("click", slideClick1);
btn[1].addEventListener("click", slideClick2);
btn[2].addEventListener("click", slideClick3);
btn[3].addEventListener("click", slideClick4);
