<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Générateur de CV Vert</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for preview icons if needed, but we use SVG in PDF -->
    <style>
        .preview-cv {
            background: white;
            padding: 40px;
            border-top: 8px solid #28a745;
            font-size: 0.9rem;
            position: relative;
        }

        .preview-header {
            text-align: center;
            border-bottom: 2px solid #28a745;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .preview-section-title {
            font-weight: bold;
            border-bottom: 1px solid #dee2e6;
            margin-top: 20px;
            color: #0f172a;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .preview-green {
            color: #28a745;
        }

        .preview-small {
            font-size: 0.75rem;
            color: #64748b;
        }

        .profil-box {
            background: #f8f9fa;
            border-left: 4px solid #28a745;
            padding: 10px;
            margin-top: 10px;
            font-size: 0.8rem;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container py-5">
        <h1 class="text-success mb-4">Crée votre CV</h1>

        <div class="row">
            <div class="col-lg-5">
                <div class="card p-4 shadow-sm mb-4">
                    <form action="generate_pdf.php" method="POST">
                        <h5 class="mb-3 text-success">Informations Générales</h5>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="small">Prénom</label>
                                <input type="text" name="firstname" id="firstname" class="form-control form-control-sm" placeholder="Yacine">
                            </div>
                            <div class="col-6">
                                <label class="small">Nom</label>
                                <input type="text" name="lastname" id="lastname" class="form-control form-control-sm" placeholder="BENBRIK">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small">Titre du Poste</label>
                            <input type="text" name="headline" id="headline" class="form-control form-control-sm" placeholder="Développeur Full-Stack">
                        </div>
                        <div class="mb-3">
                            <label class="small">Coordonnées (ex: Marseille | 07... | email@...)</label>
                            <input type="text" name="contact" id="contact" class="form-control form-control-sm" placeholder="Ville | Téléphone | Email">
                        </div>
                        <div class="mb-3">
                            <label class="small">Liens (ex: github.com/... | linkedin.com/...)</label>
                            <input type="text" name="links" id="links" class="form-control form-control-sm" placeholder="GitHub | LinkedIn">
                        </div>

                        <h5 class="mt-4 mb-3 text-success">Profil</h5>
                        <div class="mb-3">
                            <textarea name="summary" id="summary" class="form-control form-control-sm" rows="3" placeholder="Décrivez votre profil..."></textarea>
                        </div>

                        <h5 class="mt-4 mb-3 text-success d-flex justify-content-between">
                            Expériences <button type="button" class="btn btn-outline-success btn-sm" onclick="ajouterExperience()">+</button>
                        </h5>
                        <div id="container-experience" class="mb-3"></div>

                        <h5 class="mt-4 mb-3 text-success d-flex justify-content-between">
                            Expertises Techniques <button type="button" class="btn btn-outline-success btn-sm" onclick="ajouterExpertise()">+</button>
                        </h5>
                        <div id="container-expertise" class="mb-3"></div>

                        <h5 class="mt-4 mb-3 text-success d-flex justify-content-between">
                            Formations <button type="button" class="btn btn-outline-success btn-sm" onclick="ajouterFormation()">+</button>
                        </h5>
                        <div id="container-formation" class="mb-3"></div>

                        <button type="submit" class="btn btn-success w-100 mt-4 shadow">Télécharger mon CV (PDF)</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="preview-cv shadow-lg" id="cv-preview">
                    <div class="preview-header">
                        <h2 id="p-name" class="m-0 text-uppercase fw-bold">PRÉNOM NOM</h2>
                        <div id="p-title" class="preview-green fw-bold text-uppercase mt-1">TITRE DU POSTE</div>
                        <div id="p-contact" class="preview-small mt-2">Coordonnées</div>
                        <div id="p-links" class="preview-small">Liens</div>
                    </div>

                    <div id="sec-profil">
                        <div class="preview-section-title">Profil Professionnel</div>
                        <div class="profil-box" id="p-summary">Votre profil s'affichera ici...</div>
                    </div>

                    <div id="sec-expertise">
                        <div class="preview-section-title">Expertises Techniques</div>
                        <div id="p-expertises" class="mt-2" style="font-size: 0.8rem;"></div>
                    </div>

                    <div id="sec-experience">
                        <div class="preview-section-title">Expériences Professionnelles</div>
                        <div id="p-experiences" class="mt-2"></div>
                    </div>

                    <div id="sec-formation">
                        <div class="preview-section-title">Formation</div>
                        <div id="p-formations" class="mt-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/script.js"></script>
</body>

</html>