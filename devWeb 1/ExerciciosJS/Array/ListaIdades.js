let idades = [];
for (let i = 0; i < 10; i++) {
    idades[i]= Number(prompt("Informe a idade da pessoa " + (i + 1) + ":"));
}

console.log("Idades informadas: ");
for (let i = 0; i < 10; i++) {
        console.log("A idade da pessoa " + (i + 1) + " é: " + idades[i]);
}

console.log("Idades crescente: ")
 let crescente = [...idades].sort((a, b) => a - b);
for (let i = 0; i < 10; i++) {
    console.log(crescente[i]);
}

console.log("Idades decrescente: ");
let decrescente = [...idades].sort((a, b) => b - a);
for (let i = 0; i < 10; i++) {
    console.log(decrescente[i]);
}