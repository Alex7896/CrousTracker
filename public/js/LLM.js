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

function callLLM(input) {
    const apiKey = "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"

    if (!input) {
        input = document.getElementById("input").value;
    } else if (input.length === 0) {
        console.log("test")
    }

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
            document.getElementById("output").value = begin + result.choices[0]?.message?.content;
        })
        .catch(error => {
            console.error("Error:", error);
        });
}


