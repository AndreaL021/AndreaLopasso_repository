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
                10,     //veleno
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
            heal.innerHTML=``;
            let attacchi=this.data.personaggio.atk;
            let attacco;
            let def=nemico.def;
            let message= document.querySelector(".poison");
            if (nemico.poison==true && poison>0) {
                message.innerHTML=`Avvelenamento -5`;
                nemico.hp-=5;
                poison-=1;
            }else if (nemico.poison==true && poison==0) {
                message.innerHTML=`Avvelenamento terminato`;
                nemico.poison=false;
                poison=5;
            }else if (nemico.poison==false && atk!=5) {
                message.innerHTML=``;
            }
            attacco=attacchi[atk];
            if (atk<=3) {
                def=def[atk];
            }else if (atk==4) {
                def=def[0];
                this.data.personaggio.hp+=20;
            }else if (atk==5) {
                def=def[0];
                nemico.poison=true;
                message.innerHTML=`Nemico avvelenato`;
            }
            attacco-=(attacco*def/100)
            if (attacco>nemico.hp) {
                nemico.hp=0;
            }else{
                nemico.hp-=attacco;
            }
            funzioni.showDmg(attacco, nemico, poison);
        }
    },
    restart: function() {
        this.data.personaggio.hp=1000;
        this.data.personaggio.heals=5;
        this.data.nemico.hp=150;
        this.data.nemico2.hp=200;
        this.data.nemico3.hp=100;
        this.data.boss.hp=700;
        let dmg= document.querySelector(".dmg-message");
        let dmg2= document.querySelector(".dmg-message2");
        dmg.innerHTML=``;
        dmg2.innerHTML=``;
    
    }
}
let poison=5;

$(document).ready(function() {
    jQuery.messaggio();
    funzioni.message();
});

let p1=gioco.data.personaggio;
let nemico=gioco.data.nemico;
let nemico1=gioco.data.nemico;
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
        if (nemico.hp==0) {
            $(document).ready(function() {
                jQuery.messaggio();
                funzioni.message(p1);
            });
        }
        if (nemico1.hp==0 && nemico2.hp>0) {
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
        if (boss.hp==0) {
            nemico=nemico1;
            gioco.restart();
        }
        funzioni.updateGame(atk, p1, nemico);
    });
}
let heal= document.querySelector(".heal");
let pozione= document.querySelector("#heal");
pozione.addEventListener('click', function(){
    if (p1.heals>0 && p1.hp<1000) {
        p1.hp+=200;
        p1.heals-=1;
        funzioni.showDmg(200, nemico);
    }else if (p1.hp>=1000) {

        heal.innerHTML=`Vita al massimo`;
    }else{
        heal.innerHTML=`Cure finite`;
    }
    let message= document.querySelector(".poison");
    if (nemico.poison==true && poison>0) {
        message.innerHTML=`Avvelenamento -5`;
        nemico.hp-=5;
        poison-=1;
        console.log("Avvelenamento, turni rimanenti: "+(poison+1));
    }else if (nemico.poison==true && poison==0) {
        message.innerHTML=`Avvelenamento terminato`;
        nemico.poison=false;
        poison=5;
    }else if (nemico.poison==false) {
        message.innerHTML=``;
    }
    gioco.attaccNemico(nemico.atk, p1);
    funzioni.updateGame(atk, p1, nemico);
});
