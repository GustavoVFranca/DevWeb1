let numero = prompt("Iforme um número inteiro:");
console.log(numero);
switch (numero) {
    case(numero % 2 === 0):
        console.log("O número é par.");
        break;
    default:
        console.log("O número é ímpar.");
}