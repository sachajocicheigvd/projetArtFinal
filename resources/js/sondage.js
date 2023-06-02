"use strict";

document.addEventListener("DOMContentLoaded", function () {
    let dynamicFieldsContainer = document.getElementById("dynamicFields");
    let addAnswerButton = document.getElementById("addAnswer");
    let answerCounter = 3;

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
});
