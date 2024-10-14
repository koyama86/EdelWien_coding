'use strict';

let cnt = 0;

// すべての詳細の要素を
const boxes = document.querySelectorAll('.box')
cnt = boxes.length - 1

// input[type=file]のvalueが変更された時、プレビューを表示または、変更する
const changeFile = (obj, num) => {
    const image = document.querySelector(`#Box${num} img`)
    const prev = document.querySelector(`#prevFile${num}`)
    let reader = new FileReader();
    reader.onload = ((e) => {
        image.src = reader.result;
    })
    reader.readAsDataURL(obj.files[0])
    prev.value = ''
}

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
    box.classList.add('box');
  
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
      const box = document.querySelector(`#Box${num}`);
      const select = document.querySelector(`#Box${num} select`);
  
      // 新しくinputとdeleteBtnを作るとき
    if (num === cnt) {
      console.log(false)
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
      const input = document.querySelector(`#Box${num} .input`)
      const img = document.querySelector(`#Box${num} img`)
      console.log(input)
  
      // value値をリセットする(ファイルとしてただのテキストが送られる可能性があるため)
      input.value = ''
      img.src = ''
  
      // inputの属性を変更する
      if (select.value === "subtitle") {
          input.type = "text";
          input.name = `subtitle${num}`;
          input.removeAttribute('hidden', false)
          img.setAttribute('hidden', true)
        } else if (select.value === "text") {
          input.type = "text";
          input.name = `text${num}`;
          input.removeAttribute('hidden', false)
          img.setAttribute('hidden', true)
        } else if (select.value === "image") {
          input.type = "file";
          input.name = `image${num}`;
          input.removeAttribute('hidden', false)
          img.setAttribute('hidden', false)
        }
    }
  }  