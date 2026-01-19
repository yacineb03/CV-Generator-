function updatePreview() {
    let f = document.getElementById('firstname').value;
    let n = document.getElementById('lastname').value;
    document.getElementById('p-name').textContent = f + " " + n;
    document.getElementById('p-title').textContent = document.getElementById('headline').value;

    let divExp = document.getElementById('p-experiences');
    divExp.innerHTML = "";

    let blocks = document.querySelectorAll('.exp-item-gui');
    blocks.forEach(block => {
        let t = block.querySelector('input[name="exp_title[]"]').value;
        let c = block.querySelector('input[name="exp_company[]"]').value;
        let d = block.querySelector('textarea[name="exp_desc[]"]').value;

        if (t || c) {
            divExp.innerHTML += '<div class="mb-3"><strong>' + t + '</strong> chez ' + c + '<br><small>' + d + '</small></div>';
        }
    });
}

document.addEventListener('input', updatePreview);

function ajouterExperience() {
    let container = document.getElementById('container-experience');
    let div = document.createElement('div');
    div.className = "exp-item-gui mb-2";
    div.innerHTML = `
        <input type="text" name="exp_title[]" class="form-control mb-1" placeholder="Poste">
        <input type="text" name="exp_company[]" class="form-control mb-1" placeholder="Entreprise">
        <textarea name="exp_desc[]" class="form-control mb-1" placeholder="Description"></textarea>
        <button type="button" class="btn btn-sm btn-link text-danger" onclick="this.parentElement.remove(); updatePreview();">Supprimer</button>
    `;
    container.appendChild(div);
}
