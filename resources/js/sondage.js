"use strict";

// Rajout de question dans le formulaire texte

let dynamicFieldsTextContainer = document.getElementById("dynamicFieldsText");
let addAnswerButtonText = document.getElementById("addAnswerText");
let answerCounterText = 3;

addAnswerButtonText.addEventListener("click", function () {
    let newAnswerInput = document.createElement("input");
    newAnswerInput.setAttribute("type", "text");
    newAnswerInput.setAttribute("name", "answers[]");
    newAnswerInput.setAttribute("placeholder", "Réponse " + answerCounterText);
    newAnswerInput.setAttribute("id", "answer" + answerCounterText);
    // put required attribute on the newAnswerInput
    newAnswerInput.setAttribute("required", "required");

    let newAnswerLabel = document.createElement("label");
    newAnswerLabel.innerHTML = "Réponse " + answerCounterText;
    newAnswerLabel.setAttribute("for", "answer" + answerCounterText);
    dynamicFieldsTextContainer.appendChild(newAnswerLabel);
    dynamicFieldsTextContainer.appendChild(newAnswerInput);
    dynamicFieldsTextContainer.appendChild(document.createElement("br"));
    answerCounterText++;
});

// Rajout de question dans le formulaire musique

let dynamicFieldsMusicContainer = document.getElementById("dynamicFieldsMusic");
let addAnswerButtonMusic = document.getElementById("addAnswerMusic");
let answerCounterMusic = 3;

addAnswerButtonMusic.addEventListener("click", function () {
    let newAnswerInput = document.createElement("input");
    newAnswerInput.setAttribute("type", "text");
    newAnswerInput.setAttribute("name", "answers[]");
    newAnswerInput.setAttribute("placeholder", "Réponse " + answerCounterMusic);
    newAnswerInput.setAttribute("id", "answer" + answerCounterMusic);
    newAnswerInput.setAttribute("required", "required");

    let newArtistInput = document.createElement("input");
    newArtistInput.setAttribute("type", "text");
    newArtistInput.setAttribute("name", "artists[]");
    newArtistInput.setAttribute("placeholder", "Artiste " + answerCounterMusic);
    newArtistInput.setAttribute("id", "artist" + answerCounterMusic);
    newArtistInput.setAttribute("required", "required");

    let newFileInput = document.createElement("input");
    newFileInput.setAttribute("type", "file");
    newFileInput.setAttribute("name", "files[]");
    newFileInput.setAttribute("id", "file" + answerCounterMusic);
    newFileInput.setAttribute("required", "required");

    let newAnswerLabel = document.createElement("label");
    newAnswerLabel.innerHTML = "Réponse " + answerCounterMusic;
    newAnswerLabel.setAttribute("for", "answer" + answerCounterMusic);
    dynamicFieldsMusicContainer.appendChild(newAnswerLabel);
    dynamicFieldsMusicContainer.appendChild(newAnswerInput);
    dynamicFieldsMusicContainer.appendChild(newArtistInput);
    dynamicFieldsMusicContainer.appendChild(newFileInput);
    dynamicFieldsMusicContainer.appendChild(document.createElement("br"));
    answerCounterText++;
});

// Affichage formulaire texte ou musique

let formulaireTexte = document.querySelector("#formulaire-texte");
let typeText = document.querySelectorAll("input[type=radio]");

typeText.forEach(function (element) {
    element.addEventListener("change", function () {
        if (this.value == "text") {
            formulaireTexte.style.display = "block";
            document.querySelector("#formulaire-music").style.display = "none";
        }

        if (this.value == "music") {
            document.querySelector("#formulaire-music").style.display = "block";
            formulaireTexte.style.display = "none";
        }
    });
});
