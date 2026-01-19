<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Générateur de CV Vert</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-light">

    <div class="container py-5">
        <h1 class="text-success mb-4">Crée votre CV</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card p-4 shadow-sm">
                    <form action="generate_pdf.php" method="POST">
                        <div class="mb-3">
                            <label>Prénom</label>
                            <input type="text" name="firstname" id="firstname" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Nom</label>
                            <input type="text" name="lastname" id="lastname" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Titre</label>
                            <input type="text" name="headline" id="headline" class="form-control">
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <label>Expériences</label>
                                <button type="button" class="btn btn-success btn-sm" onclick="ajouterExperience()">+ Ajouter</button>
                            </div>
                            <div id="container-experience"></div>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Télécharger en PDF</button>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div id="cv-preview" class="bg-white p-4 shadow-sm border-top border-5 border-success">
                    <h2 id="p-name" class="text-dark">Prénom Nom</h2>
                    <p id="p-title" class="text-success fw-bold">Titre du poste</p>
                    <hr>
                    <h5>EXPÉRIENCES</h5>
                    <div id="p-experiences"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/script.js"></script>
</body>

</html>