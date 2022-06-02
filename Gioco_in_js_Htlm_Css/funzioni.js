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
    showNemico.setAttribute("class", "enemy1");
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
    if (nemico.id==1) {
        let showNemico= document.querySelector("#enemy");
        showNemico.setAttribute("class", "enemy1");
    }else if (nemico.id==2) {
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
    let message2= document.getElementById("message2");
    let modal= document.getElementById("message");
    let message= document.createElement("span");
    message.setAttribute("class", "text-center text-white fs-message");
    if (x==5) {
        message.innerHTML=
        `
            Gioco terminato
        `;
        message2.innerHTML=
        `
            Clicca per ricominciare
        `;
        x==0;
    }else{
        message.innerHTML=
        `
            Livello ${x}
        `;
        message2.innerHTML=
        `
            Clicca per continuare
        `;
    }
    x++;
    modal.replaceChild(message, modal.firstChild);
}

export function showDmg(p1damage, enemy) {
    let dmg= document.querySelector(".dmg-message");
    let dmg2= document.querySelector(".dmg-message2");
    if (p1damage==200) {
        dmg.innerHTML=
        `
            +${p1damage-enemy.atk}
        `;
        dmg2.innerHTML=
        `
            
        `;
    }else{
        dmg.innerHTML=
        `
            -${enemy.atk}
        `;
        dmg2.innerHTML=
        `
            -${p1damage}
        `;
    }
}