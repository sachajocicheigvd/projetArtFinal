let coll = document.getElementsByClassName("collapsible");
let i;
let svgElement = document.getElementById("boutonPlus");

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
            svgElement.style.stroke = "#767676";
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
            svgElement.style.stroke = "#27eb42";
        }
    });
}

let emailUser = document.getElementById("user-email").value;
let emailElement = document.getElementById("email");

emailElement.addEventListener("focus", function () {
    emailElement.removeAttribute("placeholder");
});

emailElement.addEventListener("blur", function () {
    emailElement.setAttribute("placeholder", emailUser);
});

let passwordElement = document.getElementById("password");

passwordElement.addEventListener("focus", function () {
    passwordElement.removeAttribute("placeholder");
});

passwordElement.addEventListener("blur", function () {
    passwordElement.setAttribute("placeholder", `●●●●●●●●`);
});
