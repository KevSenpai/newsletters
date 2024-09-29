const newsletterForm = document.getElementById('newsletter-form');
const formMessage = document.getElementById('form-message');

newsletterForm.addEventListener('submit', (event) => {
    event.preventDefault(); // Empêche le rechargement de la page

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;

    // Validation simple (vous pouvez l'améliorer)
    if (!name || !email) {
        formMessage.textContent = "Veuillez remplir tous les champs.";
        return;
    }

    // Envoyez les données au serveur (PHP) avec AJAX
    fetch('enregistrer.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `name=${name}&email=${email}`
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erreur réseau');
        }
        return response.text(); // Ou response.json() si le serveur renvoie du JSON
    })
    .then(data => {
        formMessage.textContent = data; // Affiche le message du serveur
    })
    .catch(error => {
        console.error('Erreur lors de l\'inscription :', error);
        formMessage.textContent = "Une erreur s'est produite. Veuillez réessayer.";
    });
});

