// Navigation
document.addEventListener('DOMContentLoaded', function () {
    // Menu hamburger
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');

    if (hamburger) {
        hamburger.addEventListener('click', function () {
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

    // Navigation active
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.nav-link');

    window.addEventListener('scroll', function () {
        let current = '';

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;

            if (scrollY >= (sectionTop - 200)) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    });

    // Onglets À propos
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');

    if (tabBtns.length > 0) {
        tabBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                const tabId = this.getAttribute('data-tab');

                // Retirer active de tous les boutons et panneaux
                tabBtns.forEach(b => b.classList.remove('active'));
                tabPanes.forEach(p => p.classList.remove('active'));

                // Ajouter active au bouton cliqué
                this.classList.add('active');

                // Afficher le panneau correspondant
                document.getElementById(tabId).classList.add('active');
            });
        });
    }

    // Galerie
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = [
        {
            id: 1,
            title: "Réunion mensuelle",
            description: "Notre réunion mensuelle pour discuter des projets en cours et à venir.",
            category: "reunions",
            image: "img/acc.jpg"
        },
        {
            id: 2,
            title: "Formation en leadership",
            description: "Session de formation sur le leadership et la gestion d'équipe.",
            category: "formations",
            image: "img/img-1.jpg"
        },
        {
            id: 3,
            title: "Événement annuel",
            description: "Notre événement annuel de networking avec des professionnels de différents secteurs.",
            category: "evenements",
            image: "img/visit.jpg"
        },
        {
            id: 4,
            title: "Activité communautaire",
            description: "Journée de nettoyage dans le quartier organisée par nos membres.",
            category: "communautaire",
            image: "img/img-cmu.jpg"
        },
        {
            id: 5,
            title: "Atelier entrepreneurial",
            description: "Atelier pratique sur la création d'entreprise et le business plan.",
            category: "formations",
            image: "img/amb.jpg"
        },
        {
            id: 6,
            title: "Réunion stratégique",
            description: "Réunion du comité directeur pour la planification des activités trimestrielles.",
            category: "reunions",
            image: "img/img-st.jpg"
        },
        {
            id: 7,
            title: "Collecte de fonds",
            description: "Événement de collecte de fonds pour nos projets communautaires.",
            category: "evenements",
            image: "img/img-fd.jpg"
        },
        {
            id: 8,
            title: "Soutien scolaire",
            description: "Programme de soutien scolaire pour les enfants du quartier.",
            category: "communautaire",
            image: "img/img-sc.jpg"
        },
        {
            id: 9,
            title: "Séminaire de motivation",
            description: "Séminaire avec un conférencier invité sur le thème de la motivation personnelle.",
            category: "formations",
            image: "img/bc.jpg"
        }
    ];

    const galleryGrid = document.querySelector('.gallery-grid');

    // Remplir la galerie
    function populateGallery(items) {
        if (!galleryGrid) return;

        galleryGrid.innerHTML = '';

        items.forEach(item => {
            const galleryItem = document.createElement('div');
            galleryItem.className = `gallery-item ${item.category}`;
            galleryItem.setAttribute('data-category', item.category);

            galleryItem.innerHTML = `
                <img src="${item.image}" alt="${item.title}">
                <div class="gallery-caption">
                    <h4>${item.title}</h4>
                    <p>${item.description}</p>
                </div>
            `;

            galleryItem.addEventListener('click', function () {
                openModal(item);
            });

            galleryGrid.appendChild(galleryItem);
        });
    }

    // Filtrer la galerie
    if (filterBtns.length > 0) {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                const filter = this.getAttribute('data-filter');

                // Retirer active de tous les boutons
                filterBtns.forEach(b => b.classList.remove('active'));
                // Ajouter active au bouton cliqué
                this.classList.add('active');

                // Filtrer les éléments
                if (filter === 'all') {
                    populateGallery(galleryItems);
                } else {
                    const filteredItems = galleryItems.filter(item => item.category === filter);
                    populateGallery(filteredItems);
                }
            });
        });
    }

    // Initialiser la galerie
    if (galleryGrid) {
        populateGallery(galleryItems);
    }

    // Modal de la galerie
    const modal = document.querySelector('.gallery-modal');
    const modalImage = document.querySelector('.modal-image');
    const imageTitle = document.querySelector('.image-title');
    const imageDescription = document.querySelector('.image-description');
    const closeModal = document.querySelector('.close-modal');

    function openModal(item) {
        if (!modal || !modalImage) return;

        modalImage.src = item.image;
        modalImage.alt = item.title;

        if (imageTitle) imageTitle.textContent = item.title;
        if (imageDescription) imageDescription.textContent = item.description;

        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    if (closeModal) {
        closeModal.addEventListener('click', function () {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    }

    if (modal) {
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    }

    // Formulaire de contact
    const contactForm = document.getElementById('contactForm');

    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();

            // Récupérer les valeurs
            const name = document.getElementById('contactName').value;
            const email = document.getElementById('contactEmail').value;
            const subject = document.getElementById('contactSubject').value;
            const message = document.getElementById('contactMessage').value;

            // Validation simple
            if (!name || !email || !subject || !message) {
                alert('Veuillez remplir tous les champs du formulaire.');
                return;
            }

            // Envoyer le formulaire (simulation)
            alert(`Merci ${name}! Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.`);

            // Réinitialiser le formulaire
            contactForm.reset();
        });
    }

    // Bouton retour en haut
    const backToTopBtn = document.getElementById('backToTop');

    if (backToTopBtn) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 300) {
                backToTopBtn.style.display = 'flex';
            } else {
                backToTopBtn.style.display = 'none';
            }
        });

        backToTopBtn.addEventListener('click', function () {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Newsletter
    const newsletterForm = document.querySelector('.newsletter-form');

    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const emailInput = this.querySelector('input[type="email"]');
            const email = emailInput.value;

            if (!email) {
                alert('Veuillez entrer votre adresse email.');
                return;
            }

            alert(`Merci! Votre adresse ${email} a été enregistrée pour recevoir notre newsletter.`);
            emailInput.value = '';
        });
    }

    // Formulaire d'inscription (prévisualisation)
    const inscriptionForm = document.getElementById('inscriptionForm');

    if (inscriptionForm) {
        // Générer l'aperçu du formulaire
        const formInputs = inscriptionForm.querySelectorAll('input, select, textarea');

        formInputs.forEach(input => {
            input.addEventListener('change', updatePreview);
            input.addEventListener('input', updatePreview);
        });

        function updatePreview() {
            const previewDiv = document.getElementById('formPreview');
            if (!previewDiv) return;

            const formData = new FormData(inscriptionForm);
            let previewHTML = '<h4>Aperçu de votre formulaire:</h4><ul>';

            for (let [key, value] of formData.entries()) {
                if (value) {
                    // Masquer le mot de passe dans l'aperçu
                    if (key === 'motdepasse') {
                        value = '********';
                    }
                    previewHTML += `<li><strong>${getFieldLabel(key)}:</strong> ${value}</li>`;
                }
            }

            previewHTML += '</ul>';
            previewDiv.innerHTML = previewHTML;
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
                'motdepasse': 'Mot de passe',
                'profession': 'Profession',
                'interets': 'Centres d\'intérêt',
                'commentaires': 'Commentaires'
            };

            return labels[fieldName] || fieldName;
        }
    }
});

// Fonction pour générer le PDF (simulation)
function generatePDF(formData) {
    // Dans une application réelle, vous utiliseriez une bibliothèque comme jsPDF
    // Pour cette démonstration, nous allons simuler la création d'un PDF

    let pdfContent = `
        FICHE D'ADHÉSION - AMBITION.28
        ====================================
        
        Informations personnelles:
        ---------------------------
        Nom: ${formData.nom}
        Post-Nom: ${formData.postnom}
        Prénom: ${formData.prenom}
        Genre: ${formData.genre}
        Date de naissance: ${formData.date_naissance}
        État civil: ${formData.etat_civil}
        
        Contact:
        --------
        Adresse: ${formData.adresse}
        Téléphone: ${formData.telephone}
        Email: ${formData.email}
        
        Informations complémentaires:
        -----------------------------
        Profession: ${formData.profession}
        Centres d'intérêt: ${formData.interets}
        
        Commentaires:
        -------------
        ${formData.commentaires || 'Aucun'}
        
        ====================================
        Date d'inscription: ${new Date().toLocaleDateString('fr-FR')}
    `;

    return pdfContent;
}