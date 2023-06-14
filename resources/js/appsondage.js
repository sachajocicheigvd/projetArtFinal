// import './bootstrap';

$(document).ready(function () {
    $(document).on("click", "#valider", function (e) {
        e.preventDefault();

        console.log("je passe par appsondage.js");
        let answer = $("#answer").val();

        /*   if(username == '' || message == ''){
            alert('Please enter both username and message')
            return false;
        } */

        $.ajax({
            method: "post",
            url: "/vote",
            data: { answer: answer },
            success: function (res) {
                //
            },
        });
    });
});
console.log("appsondage.js");
window.Echo.channel("sondage").listen(".sondage", (e) => {
    $("#sondages").append("<p><strong>" + e.answer + "</strong>" + "</p>");
    //$('#message').val('');
});
