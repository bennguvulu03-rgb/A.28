<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $postnom = htmlspecialchars($_POST['postnom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $genre = htmlspecialchars($_POST['genre']);
    $date_naissance = htmlspecialchars($_POST['date_naissance']);
    $etat_civil = htmlspecialchars($_POST['etat_civil']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $email = htmlspecialchars($_POST['email']);
    $profession = htmlspecialchars($_POST['profession']);
    $interets = htmlspecialchars($_POST['interets']);
    $commentaires = htmlspecialchars($_POST['commentaires']);

    // Préparer les données pour le PDF
    $donnees_inscription = array(
        'nom' => $nom,
        'postnom' => $postnom,
        'prenom' => $prenom,
        'genre' => $genre,
        'date_naissance' => $date_naissance,
        'etat_civil' => $etat_civil,
        'adresse' => $adresse,
        'telephone' => $telephone,
        'email' => $email,
        'profession' => $profession,
        'interets' => $interets,
        'commentaires' => $commentaires,
        'date_inscription' => date('d/m/Y H:i:s')
    );

    // Générer le contenu du PDF
    $contenu_pdf = "
        FICHE D'ADHÉSION - AMBITION.28
        ====================================
        
        Informations personnelles:
        ---------------------------
        Nom: {$donnees_inscription['nom']}
        Post-Nom: {$donnees_inscription['postnom']}
        Prénom: {$donnees_inscription['prenom']}
        Genre: {$donnees_inscription['genre']}
        Date de naissance: {$donnees_inscription['date_naissance']}
        État civil: {$donnees_inscription['etat_civil']}
        
        Contact:
        --------
        Adresse: {$donnees_inscription['adresse']}
        Téléphone: {$donnees_inscription['telephone']}
        Email: {$donnees_inscription['email']}
        
        Informations complémentaires:
        -----------------------------
        Profession: {$donnees_inscription['profession']}
        Centres d'intérêt: {$donnees_inscription['interets']}
        
        Commentaires:
        -------------
        {$donnees_inscription['commentaires']}
        
        ====================================
        Date d'inscription: {$donnees_inscription['date_inscription']}
    ";

    // Encoder le contenu pour l'envoyer via WhatsApp
    $texte_whatsapp = urlencode("Nouvelle inscription Ambition.28:\n\n" . $contenu_pdf);
    $numero_whatsapp = "243812345678"; // Remplacez par le numéro réel

    // Rediriger vers la page de confirmation
    header('Location: confirmation.php?nom=' . urlencode($nom) . '&prenom=' . urlencode($prenom) . '&whatsapp=' . $texte_whatsapp);
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Ambition.28</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Barre de navigation -->
    <header>
        <nav class="navbar">
            <div class="logo">
                <h1>Ambition<span>.28</span></h1>
            </div>
            <ul class="nav-menu">
                <li><a href="index.html#accueil" class="nav-link">Accueil</a></li>
                <li><a href="index.html#apropos" class="nav-link">À propos</a></li>
                <li><a href="index.html#galerie" class="nav-link">Galerie</a></li>
                <li><a href="index.html#contact" class="nav-link">Contact</a></li>
                <li><a href="inscription.html" class="nav-link btn-inscription active">Inscription</a></li>
            </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
    </header>

    <!-- Section Inscription -->
    <section class="inscription-page">
        <div class="inscription-container">
            <div class="inscription-header">
                <h2>Formulaire d'adhésion</h2>
                <p>Rejoignez Ambition.28 en remplissant ce formulaire. Tous les champs marqués d'un * sont obligatoires.</p>
            </div>

            <form id="inscriptionForm" method="POST" action="inscription.html">
                <div class="form-row">
                    <div class="form-field">
                        <label for="nom">Nom *</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>

                    <div class="form-field">
                        <label for="postnom">Post-Nom *</label>
                        <input type="text" id="postnom" name="postnom" required>
                    </div>

                    <div class="form-field">
                        <label for="prenom">Prénom *</label>
                        <input type="text" id="prenom" name="prenom" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-field">
                        <label for="genre">Genre *</label>
                        <select id="genre" name="genre" required>
                            <option value="">Sélectionnez</option>
                            <option value="Masculin">Masculin</option>
                            <option value="Féminin">Féminin</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>

                    <div class="form-field">
                        <label for="date_naissance">Date de naissance *</label>
                        <input type="date" id="date_naissance" name="date_naissance" required>
                    </div>

                    <div class="form-field">
                        <label for="etat_civil">État civil *</label>
                        <select id="etat_civil" name="etat_civil" required>
                            <option value="">Sélectionnez</option>
                            <option value="Célibataire">Célibataire</option>
                            <option value="Marié(e)">Marié(e)</option>
                            <option value="Divorcé(e)">Divorcé(e)</option>
                            <option value="Veuf(ve)">Veuf(ve)</option>
                        </select>
                    </div>
                </div>

                <div class="form-field">
                    <label for="adresse">Adresse complète *</label>
                    <textarea id="adresse" name="adresse" rows="2" required placeholder="Rue, avenue, numéro, quartier, ville..."></textarea>
                </div>

                <div class="form-row">
                    <div class="form-field">
                        <label for="telephone">Téléphone *</label>
                        <input type="tel" id="telephone" name="telephone" required placeholder="+243 XX XXX XXXX">
                    </div>

                    <div class="form-field">
                        <label for="email">Adresse email *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-field">
                        <label for="profession">Profession/Occupation</label>
                        <input type="text" id="profession" name="profession" placeholder="Étudiant, Enseignant, Entrepreneur, etc.">
                    </div>

                    <div class="form-field">
                        <label for="interets">Centres d'intérêt</label>
                        <input type="text" id="interets" name="interets" placeholder="Leadership, Entrepreneuriat, Développement personnel, etc.">
                    </div>
                </div>

                <div class="form-field">
                    <label for="commentaires">Commentaires ou motivations pour rejoindre Ambition.28</label>
                    <textarea id="commentaires" name="commentaires" rows="4" placeholder="Pourquoi souhaitez-vous rejoindre notre structure? Quelles sont vos attentes?"></textarea>
                </div>

                <div class="terms-container">
                    <div class="terms-text">
                        <h4>Conditions d'adhésion à Ambition.28</h4>
                        <p>1. En soumettant ce formulaire, vous exprimez votre volonté de devenir membre d'Ambition.28.</p>
                        <p>2. Vous vous engagez à respecter les valeurs et les règles de fonctionnement de la structure.</p>
                        <p>3. Vous acceptez de participer activement aux activités de la structure dans la mesure de vos disponibilités.</p>
                        <p>4. Vous autorisez Ambition.28 à utiliser vos données personnelles uniquement dans le cadre des activités de la structure.</p>
                        <p>5. L'adhésion est soumise à l'approbation du comité directeur d'Ambition.28.</p>
                        <p>6. Vous pouvez mettre fin à votre adhésion à tout moment en informant par écrit le comité directeur.</p>
                    </div>

                    <div class="terms-agreement">
                        <input type="checkbox" id="accept_terms" name="accept_terms" required>
                        <label for="accept_terms">Je déclare avoir lu et accepté les conditions d'adhésion *</label>
                    </div>
                </div>

                <div id="formPreview" class="form-preview" style="background-color: #f9f9f9; padding: 20px; border-radius: 5px; margin-bottom: 20px; display: none;">
                    <!-- L'aperçu sera généré ici par JavaScript -->
                </div>

                <button type="submit" class="btn submit-btn">Soumettre ma candidature</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Ambition<span>.28</span></h3>
                <p>Structure de développement personnel, professionnel et communautaire.</p>
                <p>Rejoignez-nous pour grandir ensemble.</p>
            </div>

            <div class="footer-section">
                <h4>Liens rapides</h4>
                <ul>
                    <li><a href="index.html#accueil">Accueil</a></li>
                    <li><a href="index.html#apropos">À propos</a></li>
                    <li><a href="index.html#galerie">Galerie</a></li>
                    <li><a href="index.html#contact">Contact</a></li>
                    <li><a href="inscription.html">Inscription</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h4>Contact</h4>
                <p><i class="fas fa-map-marker-alt"></i> 123 Avenue de l'Ambition, Kinshasa</p>
                <p><i class="fas fa-phone"></i> +243 81 234 5678</p>
                <p><i class="fas fa-envelope"></i> info@ambition28.org</p>
            </div>

            <div class="footer-section">
                <h4>Newsletter</h4>
                <p>Inscrivez-vous pour recevoir nos actualités</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Votre email" required>
                    <button type="submit"><i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2023 Ambition.28 - Tous droits réservés. | Conçu avec <i class="fas fa-heart"></i> pour la communauté</p>
        </div>
    </footer>

    <!-- Bouton retour en haut -->
    <button id="backToTop" class="back-to-top">
        <i class="fas fa-chevron-up"></i>
    </button>

    <script src="script.js"></script>
    <script>
        // Script spécifique à la page d'inscription
        document.addEventListener('DOMContentLoaded', function() {
            // Menu hamburger
            const hamburger = document.querySelector('.hamburger');
            const navMenu = document.querySelector('.nav-menu');

            if (hamburger) {
                hamburger.addEventListener('click', function() {
                    this.classList.toggle('active');
                    navMenu.classList.toggle('active');
                });

                // Fermer le menu en cliquant sur un lien
                document.querySelectorAll('.nav-link').forEach(link => {
                    link.addEventListener('click', () => {
                        hamburger.classList.remove('active');
                        navMenu.classList.remove('active');
                    });
                });
            }

            // Aperçu du formulaire
            const formInputs = document.querySelectorAll('#inscriptionForm input, #inscriptionForm select, #inscriptionForm textarea');
            const previewDiv = document.getElementById('formPreview');

            formInputs.forEach(input => {
                input.addEventListener('change', updatePreview);
                input.addEventListener('input', updatePreview);
            });

            function updatePreview() {
                if (!previewDiv) return;

                // Vérifier si au moins un champ est rempli
                let hasContent = false;
                formInputs.forEach(input => {
                    if (input.value && input.type !== 'checkbox') {
                        hasContent = true;
                    }
                });

                if (hasContent) {
                    previewDiv.style.display = 'block';

                    const formData = new FormData(document.getElementById('inscriptionForm'));
                    let previewHTML = '<h4>Aperçu de votre formulaire:</h4><ul>';

                    for (let [key, value] of formData.entries()) {
                        if (value && key !== 'accept_terms') {
                            previewHTML += `<li><strong>${getFieldLabel(key)}:</strong> ${value}</li>`;
                        }
                    }

                    previewHTML += '</ul>';
                    previewDiv.innerHTML = previewHTML;
                } else {
                    previewDiv.style.display = 'none';
                }
            }

            function getFieldLabel(fieldName) {
                const labels = {
                    'nom': 'Nom',
                    'postnom': 'Post-Nom',
                    'prenom': 'Prénom',
                    'genre': 'Genre',
                    'date_naissance': 'Date de naissance',
                    'etat_civil': 'État civil',
                    'adresse': 'Adresse',
                    'telephone': 'Téléphone',
                    'email': 'Email',
                    'profession': 'Profession',
                    'interets': 'Centres d\'intérêt',
                    'commentaires': 'Commentaires'
                };

                return labels[fieldName] || fieldName;
            }

            // Bouton retour en haut
            const backToTopBtn = document.getElementById('backToTop');

            if (backToTopBtn) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 300) {
                        backToTopBtn.style.display = 'flex';
                    } else {
                        backToTopBtn.style.display = 'none';
                    }
                });

                backToTopBtn.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        });
    </script>
</body>

</html>