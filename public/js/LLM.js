document.addEventListener('DOMContentLoaded', function() {
    const inputField = document.getElementById('input');

    // Ajouter un événement pour détecter la touche "Entrée"
    inputField?.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();  // Empêche l'action par défaut de la touche "Entrée"
            callLLM();  // Appelle la fonction callLLM
        }
    });
});

function callLLM() {
    const apiKey = "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"

    let input = document.getElementById("input").value;

    let url = "https://api.groq.com/openai/v1/chat/completions";

    const data = {
        messages: [
            {
                role: "user",
                content: `${input}`,
            }
        ],
        model: "llama-3.1-8b-instant"
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
            document.getElementById("output").value = result.choices[0].message.content;
        })
        .catch(error => {
            console.error("Error:", error);
        });
}