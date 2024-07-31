const btnAdd = document.getElementsByName("btnAdd");

btnAdd = addEventListener("click", () => {
  let altura = Number(document.getElementById("altura").value);
  let peso = Number(document.getElementById("peso").value);
  let imcPaciente = document.getElementById("imcPaciente");
  const calcImc = peso / (altura * altura);
  imcPaciente.innerHTML = `${calcImc.toFixed(2)}`;
});
