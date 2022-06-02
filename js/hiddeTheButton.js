const btnLien = document.getElementById("btnLien")
const btnFichier = document.getElementById("btnFichier")

btnLien.addEventListener("click", MyFunction1);
btnFichier.addEventListener("click", MyFunction2);

function MyFunction1() {
    if (btnFichier.style.display === 'none') {
        btnFichier.style.display = 'block'
    } else {
        btnFichier.style.display = 'none'
    }
}
function MyFunction2() {
    if (btnLien.style.display === 'none') {
        btnLien.style.display = 'block'
    } else {
        btnLien.style.display = 'none'
    }
}