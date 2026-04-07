let posição = prompt("Informe a posição da carta (1-52)");
console.log(posição);
let resto = posição % 4;
let jogadores = ["Jogador 1", "Jogador 2", "Jogador 3", "Jogador 4"];
switch (resto) {
    case 1:
        console.log(jogadores[0]);
        break;  
    case 2:
        console.log(jogadores[1]);
        break;
    case 3:
        console.log(jogadores[2]);
        break;
    case 0:
        console.log(jogadores[3]);
        break;
}