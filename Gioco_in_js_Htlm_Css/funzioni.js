let vita = document.querySelector(".vita");
let pozioni = document.querySelector(".pozioni");
let livello = document.querySelector(".livello");
let nemicohp = document.querySelector(".enemyhp");

export let attacchi=[
    "Fisico",
    "Fuoco",
    "Fulmine",
    "Acqua",
    "Cura",
    "Veleno",
];
export function showGame(atk, p1, nemico){
    let showNemico= document.querySelector("#enemy");
    showNemico.setAttribute("class", "enemy");
    let elemento= document.createElement("ul");
    for (let i = 0; i < this.attacchi.length; i++) {
        elemento.innerHTML+=
        `
            <li><button value="${i}" id="button${i}" class="btn b bg-white m-1">${attacchi[i]}</button></li>
        `;
    }
    elemento.innerHTML+=
        `
            <li><button id="heal" class="btn b text-white bg-green d-flex justify-content-center m-1">Pozione</button></li>
        `;
    atk.appendChild(elemento);
    vita.innerHTML=('Vita: '+p1.hp);
    pozioni.innerHTML=('Pozioni: '+p1.heals);
    livello.innerHTML=('Livello: '+p1.lvl);
    nemicohp.innerHTML=('Vita: '+nemico.hp);
};
export function updateGame(atk, p1, nemico){
    if (nemico.id==2) {
        let showNemico= document.querySelector("#enemy");
        showNemico.setAttribute("class", "enemy2");
    } else if (nemico.id==3) {
        let showNemico= document.querySelector("#enemy");
        showNemico.setAttribute("class", "enemy3");
    } else if (nemico.id==4) {
        let showNemico= document.querySelector("#enemy");
        showNemico.setAttribute("class", "boss");
    }
    vita.innerHTML=('Vita: '+p1.hp);
    pozioni.innerHTML=('Pozioni: '+p1.heals);
    livello.innerHTML=('Livello: '+p1.lvl);
    nemicohp.innerHTML=('Vita: '+nemico.hp);
}
let x=1;
export function message() {
    let modal= document.getElementById("message");
    let message= document.createElement("span");
    message.setAttribute("class", "text-center text-white fs-message");
    if (x==5) {
        message.innerHTML=
        `
            Gioco terminato
        `;
    }else{
        message.innerHTML=
        `
            Livello ${x}
        `;
    }
    x++;
    if (x>=2) {
        modal.replaceChild(message, modal.firstChild);
    }else{
        modal.appendChild(message);
    }
}
export function showDmg() {
    let modal= document.getElementById("message");
    let message= document.createElement("span");
    message.setAttribute("class", "text-center text-white fs-message");
        message.innerHTML=
        `
            Gioco terminato
        `;
    x++;
    if (x>=2) {
        modal.replaceChild(message, modal.firstChild);
    }else{
        modal.appendChild(message);
    }
}