"use strict";

let dynamicFieldsContainer = document.getElementById("dynamicFields");
let addAnswerButton = document.getElementById("addAnswer");
let answerCounter = 1;

// document.addEventListener("DOMContentLoaded", function () {

addAnswerButton.addEventListener("click", function () {
    let newAnswerInput = document.createElement("input");
    newAnswerInput.setAttribute("type", "text");
    newAnswerInput.setAttribute("name", "answers[]");
    newAnswerInput.setAttribute("placeholder", "Réponse " + answerCounter);
    newAnswerInput.setAttribute("id", "answer" + answerCounter);
    // put required attribute on the newAnswerInput
    newAnswerInput.setAttribute("required", "required");

    let newAnswerLabel = document.createElement("label");
    newAnswerLabel.innerHTML = "Réponse " + answerCounter;
    newAnswerLabel.setAttribute("for", "answer" + answerCounter);
    dynamicFieldsContainer.appendChild(newAnswerLabel);
    dynamicFieldsContainer.appendChild(newAnswerInput);
    dynamicFieldsContainer.appendChild(document.createElement("br"));
    answerCounter++;
});

// Select all radio input type=radio without class

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
