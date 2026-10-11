function updatePreview() {
    let f = document.getElementById('firstname').value || "PRÉNOM";
    let n = document.getElementById('lastname').value || "NOM";
    document.getElementById('p-name').textContent = f + " " + n;

    document.getElementById('p-title').textContent = document.getElementById('headline').value || "TITRE DU POSTE";
    document.getElementById('p-contact').textContent = document.getElementById('contact').value || "Marseille, France | 07... | email@...";
    document.getElementById('p-links').textContent = document.getElementById('links').value || "github.com/... | linkedin.com/...";
    document.getElementById('p-summary').textContent = document.getElementById('summary').value || "Votre profil s'affichera ici...";

    // Expertises
    let divExpT = document.getElementById('p-expertises');
    divExpT.innerHTML = "";
    let eblocks = document.querySelectorAll('#container-expertise .expertise-item-gui');
    eblocks.forEach(block => {
        let c = block.querySelector('input[name="exp_cat[]"]').value;
        let s = block.querySelector('input[name="exp_skills[]"]').value;
        if (c || s) {
            divExpT.innerHTML += '<div class="mb-1"><strong>' + c + ' :</strong> ' + s + '</div>';
        }
    });

    // Expériences
    let divExp = document.getElementById('p-experiences');
    divExp.innerHTML = "";
    let blocks = document.querySelectorAll('#container-experience .exp-item-gui');
    blocks.forEach(block => {
        let t = block.querySelector('input[name="exp_title[]"]').value;
        let c = block.querySelector('input[name="exp_company[]"]').value;
        let d = block.querySelector('textarea[name="exp_desc[]"]').value;
        if (t || c) {
            divExp.innerHTML += '<div class="mb-2"><strong>' + t + '</strong> <br><small class="text-muted italic">' + c + '</small><br><div class="small">' + d.replace(/\n/g, '<br>') + '</div></div>';
        }
    });

    // Formations
    let divForm = document.getElementById('p-formations');
    divForm.innerHTML = "";
    let fblocks = document.querySelectorAll('#container-formation .form-item-gui');
    fblocks.forEach(block => {
        let t = block.querySelector('input[name="form_title[]"]').value;
        let c = block.querySelector('input[name="form_school[]"]').value;
        if (t || c) {
            divForm.innerHTML += '<div class="mb-2"><strong>' + t + '</strong> <br><small class="preview-green">' + c + '</small></div>';
        }
    });
}

document.addEventListener('input', updatePreview);

function ajouterExperience() {
    let container = document.getElementById('container-experience');
    let div = document.createElement('div');
    div.className = "exp-item-gui border-start border-success border-3 ps-2 mb-3 bg-white p-2 rounded";
    div.innerHTML = `
        <input type="text" name="exp_title[]" class="form-control form-control-sm mb-1" placeholder="Poste (ex: Développeur)">
        <input type="text" name="exp_company[]" class="form-control form-control-sm mb-1" placeholder="Entreprise / Date (ex: Freelance | 2023)">
        <textarea name="exp_desc[]" class="form-control form-control-sm mb-1" placeholder="Description / Tâches"></textarea>
        <button type="button" class="btn btn-sm p-0 text-danger border-0 bg-transparent" onclick="this.parentElement.remove(); updatePreview();">Supprimer</button>
    `;
    container.appendChild(div);
}

function ajouterExpertise() {
    let container = document.getElementById('container-expertise');
    let div = document.createElement('div');
    div.className = "expertise-item-gui border-start border-warning border-3 ps-2 mb-3 bg-white p-2 rounded";
    div.innerHTML = `
        <input type="text" name="exp_cat[]" class="form-control form-control-sm mb-1" placeholder="Catégorie (ex: Back-end)">
        <input type="text" name="exp_skills[]" class="form-control form-control-sm mb-1" placeholder="Compétences (ex: PHP, Node.js)">
        <button type="button" class="btn btn-sm p-0 text-danger border-0 bg-transparent" onclick="this.parentElement.remove(); updatePreview();">Supprimer</button>
    `;
    container.appendChild(div);
}

function ajouterFormation() {
    let container = document.getElementById('container-formation');
    let div = document.createElement('div');
    div.className = "form-item-gui border-start border-primary border-3 ps-2 mb-3 bg-white p-2 rounded";
    div.innerHTML = `
        <input type="text" name="form_title[]" class="form-control form-control-sm mb-1" placeholder="Diplôme / Formation">
        <input type="text" name="form_school[]" class="form-control form-control-sm mb-1" placeholder="École / Date">
        <button type="button" class="btn btn-sm p-0 text-danger border-0 bg-transparent" onclick="this.parentElement.remove(); updatePreview();">Supprimer</button>
    `;
    container.appendChild(div);
}
