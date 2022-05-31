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
    let elemento= document.createElement("div");
    elemento.setAttribute("class", "row d-flex justify-content-center");
    elemento.setAttribute("style", "width: 30vw;"); 
    for (let i = 0; i < this.attacchi.length; i++) {
        elemento.innerHTML+=
        `
            <button value="${i}" id="button${i}" class="btn b bg-white col-5 m-1">${attacchi[i]}</button>
        `;
    }
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