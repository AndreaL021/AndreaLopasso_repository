import * as funzioni from './funzioni.js';
import * as jQuery from "./jQuery.js";

let gioco={
    data:{
        personaggio: {
            hp:1000,
            xp:0,
            heals:5,
            lvl:1,
            atk: [
                30,     //fisico
                25,     //fuoco
                25,     //fulmine
                25,     //acqua
                20,     //cura
                10,      //veleno
            ]
        },
        nemico: {
            hp:150,
            def: [
                30,
                50,
                -30,
                10,
            ],
            atk:30,
            poison:false,
            xp:20,
            id:1,
        },
        nemico2: {
            hp:200,
            def: [
                40,
                20,
                30,
                -20,
            ],
            atk:40,
            poison:false,
            xp:50,
            id:2,
        },
        nemico3: {
            hp:100,
            def: [
                10,
                0,
                -20,
                -10,
            ],
            atk:70,
            poison:false,
            xp:30,
            id:3,
        },
        boss: {
            hp:700,
            def: [
                20,
                -30,
                40,
                10,
            ],
            atk:50,
            poison:false,
            heals:1,
            xp:30,
            id:4,
        },
    },
    attaccNemico: function(atk, personaggio) {
        if (nemico.hp>0) {
            if (personaggio.hp<atk) {
                personaggio.hp=0;
            }else{
                personaggio.hp-=atk;
            }
        }
    },
    attacco: function(atk, nemico) {
        if (nemico.hp>0 && this.data.personaggio.hp>0) {
            
            let attacchi=this.data.personaggio.atk;
            let attacco;
            let def=nemico.def;

            if (nemico.poison==true && poison>0) {
                nemico.hp-=5;
                poison-=1;
                console.log("Avvelenamento, turni rimanenti: "+(poison+1));
            }else if (nemico.poison==true && poison==0) {
                nemico.poison=false;
                poison=3;
                console.log("Avvelenamento terminato");
            }

            for (let i = 0; i < attacchi.length; i++) {
                if (atk==i) {
                    attacco=attacchi[i];
                    if (i<=3) {
                        def=def[i];
                    }else if (i==4) {
                        def=def[1];
                        this.data.personaggio.hp+=20;
                    }else if (i==5) {
                        def=def[1];
                        nemico.poison=true;
                        console.log("Nemico avvelenato");
                    }
                }
            }
            attacco-=(attacco*def/100)
            if (attacco>nemico.hp) {
                nemico.hp=0;
            }else{
                nemico.hp-=attacco;
            }
        }
    },
}
let poison=5;

$(document).ready(function() {
    jQuery.messaggio();
    funzioni.message();
});

let p1=gioco.data.personaggio;
let nemico=gioco.data.nemico;
let nemico2=gioco.data.nemico2;
let nemico3=gioco.data.nemico3;
let boss=gioco.data.boss;
let nemici=[nemico, nemico2, nemico3, boss];

let atk = document.querySelector(".atk");

funzioni.showGame(atk, p1, nemico);


for (let i = 0; i < funzioni.attacchi.length; i++){
    let button= document.querySelector("#button"+i);
    button.addEventListener('click', function(){
        let attacco = button.value;

        gioco.attacco(attacco, nemico)
        gioco.attaccNemico(nemico.atk, p1)
        console.log(nemico.hp);
        if (nemico.hp==0) {
            $(document).ready(function() {
                jQuery.messaggio();
                funzioni.message();
            });
        }
        if (nemico.hp==0 && nemico2.hp>0) {
            nemico=nemico2;
            funzioni.updateGame(atk, p1, nemico);
        }
        if (nemico2.hp==0 && nemico3.hp>0) {
            nemico=nemico3;
            funzioni.updateGame(atk, p1, nemico);
        }
        if (nemico3.hp==0 && boss.hp>0) {
            nemico=boss;
            funzioni.updateGame(atk, p1, nemico);
        }
        funzioni.updateGame(atk, p1, nemico);
    });
}

let pozione= document.querySelector("#heal");
pozione.addEventListener('click', function(){
    if (p1.heals>0 && p1.hp<1000) {
        p1.hp+=200;
        p1.heals-=1;
    }else if (p1.hp>=200) {
        console.log("Vita al massimo");
    }else{
        console.log("Cure finite");
    }
    gioco.attaccNemico(nemico.atk, p1)
    console.log(nemico.hp);
    funzioni.updateGame(atk, p1, nemico);
});
// $(document).ready(function(){
//     $("button").hover(function(){
//         $(this).css("background-color", "yellow");
//     });
// });

// for (let i = 0; i < this.elementi.length; i++) {
// document.querySelector("#button").addEventListener("mouseover", function(){
//     // let button = document.querySelector("#button").hover(function(){
//         $(this.document).css("background-color", "yellow");
//     // });
// });
// }
// console.log(elemento);

// gioco.pozione(boss);
// gioco.attacco(boss.atk, p1);
// gioco.attacco(p1.atk.fuoco, boss);
// console.log(p1);
// console.log(boss.hp);
// console.log(nemico);
// console.log(nemico2);
// console.log(nemico3);