document.addEventListener('DOMContentLoaded', function () {
    const inputField = document.getElementById('input');

    // Ajouter un événement pour détecter la touche "Entrée"
    inputField?.addEventListener('keypress', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();  // Empêche l'action par défaut de la touche "Entrée"
            callLLM();  // Appelle la fonction callLLM
        }
    });
});

/**
 * Fonction pour appeler l'API Groq du modèle Llama-3 et générer un résumé des avis de restaurant.
 * @param {string} input - Texte à analyser et résumer.
 */
function callLLM(input) {
    // Clé API pour accéder au service d'IA
    const apiKey = "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"

    if (input.length !== 0) {
        let url = "https://api.groq.com/openai/v1/chat/completions";

        const begin = "Voici un résumé des avis de restaurant :";

        const data = {
            "messages": [
                {
                    "role": "system",
                    "content": "Tu es un assistant qui résume les avis de restaurant avec un texte court",
                },
                {
                    "role": "user",
                    "content": `${JSON.stringify(input)}`,
                },
                {
                    "role": "assistant",
                    "content": `${begin}`
                }
            ],
            "temperature": 0.5,
            "max_completion_tokens": 300,
            "model": "llama-3.3-70b-versatile",
            "stop": ""
        };

        fetch(url, {
            method: "POST",
            headers: {
                "Authorization": `Bearer ${apiKey}`,
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(result => {
                // Insérer la réponse de l'IA dans le champ de sortie
                document.getElementById("output").value = begin + result.choices[0]?.message?.content;
            })
            .catch(error => {
                console.error("Error:", error);
            });
    } else {
        // Afficher un message si aucun avis n'est fourni
        document.getElementById("output").value = "Aucun avis disponible."
    }
}


