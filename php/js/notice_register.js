"use strict";

/*
1: プルダウンからcontentのtypeを指定される
2: inputタグを作り、選択されたtypeを指定する
3: appendChild()でinputと削除ボタンを入れる
4: cntを+1する
5: 次の行のプルダウンを表示する

* onchangeからnumを引数として受け取って、操作する部分を指定する
num < cntの時、すでにinputを定義済みのため、inputのname属性とtype属性のみを変更する

* 削除ボタンは要素自体を削除せず、value値を空にして、
div#Box+numにdisplay:noneをかける
(value値が空の場合はデータベースに登録されない処理にしているため)
*/

// 現在の要素数を格納する
let cnt = 0;

// 削除ボタンが押された時
function deleteContent(num) {
  const box = document.querySelector("#Box" + num);
  const input = document.querySelector("#Box" + num + " input");
  input.value = "";
  box.classList.add("hidden");
}

// 次の行のselectを作る
function createSelect(num) {
  // Boxを作る
  let box = document.createElement("div");
  box.id = `Box${num}`;

  // selectタグを作る
  let select = document.createElement("select");
  select.setAttribute("onchange", `selectContent(${num})`);

  // optionタグを作る
  let option1 = document.createElement("option");
  option1.innerHTML = "形式を選択してください";
  option1.setAttribute("selected", true);
  option1.disabled = true;
  let option2 = document.createElement("option");
  option2.value = "subtitle";
  option2.innerHTML = "サブタイトル";
  let option3 = document.createElement("option");
  option3.value = "text";
  option3.innerHTML = "テキスト";
  let option4 = document.createElement("option");
  option4.value = "image";
  option4.textContent = "画像";

  //  selectの中にoptionを格納する
  select.appendChild(option1);
  select.appendChild(option2);
  select.appendChild(option3);
  select.appendChild(option4);

  // boxの中にselectを格納する
  box.appendChild(select);

  // ひとつ前のboxの次に配置する
  const prev_box = document.querySelector(`#Box${num - 1}`);
  prev_box.insertAdjacentHTML("afterend", box.outerHTML);
}

function selectContent(num) {
    console.log('ok')
    const box = document.querySelector(`#Box${num}`);
    const select = document.querySelector(`#Box${num} select`);

    // 新しくinputとdeleteBtnを作るとき
  if (num === cnt) {
    const detail_cnt = document.querySelector('#detail_cnt');

    // inputを作成する
    let input = document.createElement("input");
    if (select.value === "subtitle") {
      input.type = "text";
      input.name = `subtitle${num}`;
    } else if (select.value === "text") {
      input.type = "text";
      input.name = `text${num}`;
    } else if (select.value === "image") {
      input.type = "file";
      input.name = `image${num}`;
      input.accept = 'image/*';
    }

    // deleteBtn(削除ボタン)を作成する
    let deleteBtn = document.createElement("button");
    deleteBtn.type = "button";
    deleteBtn.textContent = "削除";
    deleteBtn.setAttribute("onclick", `deleteContent(${num})`);

    //   boxにinputとdeleteBtnを格納する
    box.appendChild(input);
    box.appendChild(deleteBtn);

    cnt++;

    // 次の行のselectを作る
    createSelect(cnt);

    // detail_cntのvalueを更新する
    detail_cnt.value = cnt;

    // 既存のinputとdeleteBtnがあるとき
  } else {
    const input = document.querySelector(`#Box${num} input`)

    // value値をリセットする(ファイルとしてただのテキストが送られる可能性があるため)
    input.value = ''

    // inputの属性を変更する
    if (select.value === "subtitle") {
        input.type = "text";
        input.name = `subtitle${num}`;
      } else if (select.value === "text") {
        input.type = "text";
        input.name = `text${num}`;
      } else if (select.value === "image") {
        input.type = "file";
        input.name = `image${num}`;
      }
  }
}
