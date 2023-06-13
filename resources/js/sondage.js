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
    newAnswerInput.setAttribute("class", "secondaire reponseTexte");
    // put required attribute on the newAnswerInput
    newAnswerInput.setAttribute("required", "required");

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
    newAnswerInput.setAttribute("placeholder", "Titre " + answerCounterMusic);
    newAnswerInput.setAttribute("id", "answer" + answerCounterMusic);
    newAnswerInput.setAttribute("class", "secondaire reponseMusique titreAdd");
    newAnswerInput.setAttribute("required", "required");

    let newArtistInput = document.createElement("input");
    newArtistInput.setAttribute("type", "text");
    newArtistInput.setAttribute("name", "artists[]");
    newArtistInput.setAttribute("placeholder", "Artiste " + answerCounterMusic);
    newArtistInput.setAttribute("id", "artist" + answerCounterMusic);
    newArtistInput.setAttribute("class", "secondaire reponseMusique");
    newArtistInput.setAttribute("required", "required");

    let newFileLabel = document.createElement("label");
    newFileLabel.setAttribute("for", "files" + answerCounterMusic);
    newFileLabel.setAttribute("class", "custom-file secondaire");
    newFileLabel.innerHTML = "Cover" + answerCounterMusic;

    let newFileInput = document.createElement("input");
    newFileInput.setAttribute("type", "file");
    newFileInput.setAttribute("name", "files[]");
    newFileInput.setAttribute("id", "files" + answerCounterMusic);
    newFileInput.setAttribute("required", "required");
    newFileInput.setAttribute("class", "upload");

    dynamicFieldsMusicContainer.appendChild(newAnswerInput);
    dynamicFieldsMusicContainer.appendChild(newArtistInput);
    dynamicFieldsMusicContainer.appendChild(document.createElement("br"));
    dynamicFieldsMusicContainer.appendChild(newFileLabel);
    dynamicFieldsMusicContainer.appendChild(newFileInput);
    dynamicFieldsMusicContainer.appendChild(document.createElement("br"));
    answerCounterMusic++;
    refreshSelection();
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

const inputs = document.querySelectorAll(".upload");
const inputsLabel = document.querySelectorAll(".custom-file");

for (let i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener("change", function (e) {
        inputsLabel[i].innerHTML = inputs[i].files[0].name;
        inputsLabel[i].style.color = "#FFFFFF";
    });
}

const refreshSelection = () => {
    const inputs = document.querySelectorAll(".upload");
    const inputsLabel = document.querySelectorAll(".custom-file");

    for (let i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener("change", function (e) {
            inputsLabel[i].innerHTML = inputs[i].files[0].name;
            inputsLabel[i].style.color = "#FFFFFF";
        });
    }
};
