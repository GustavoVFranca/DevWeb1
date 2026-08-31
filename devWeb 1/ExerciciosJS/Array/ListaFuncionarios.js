let fila = [];

for (let i = 0; i < 5; i++) {
    let id = Number(prompt("ID do funcionário:"));
    let nome = prompt("Nome:");
    let salario = Number(prompt("Salário:"));
    let idade = Number(prompt("Idade:"));

    let funcionario = {
        id: id,
        nome: nome,
        salario: salario,
        idade: idade
    };

    fila.push(funcionario);
}
let maisNovo = fila[0];
let maiorSalario = fila[0];

for (let i = 1; i < fila.length; i++) {
    if (fila[i].idade < maisNovo.idade) {
        maisNovo = fila[i];
    }

    if (fila[i].salario > maiorSalario.salario) {
        maiorSalario = fila[i];
    }
}

console.log("Funcionário mais novo:", maisNovo.nome);
console.log("Idade do funcionário com maior salário:", maiorSalario.idade);
