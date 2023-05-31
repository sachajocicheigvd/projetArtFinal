import "./bootstrap";

import { createApp } from "vue";
import ChatForm from "./components/ChatForm.vue";
import ChatMessages from "./components/ChatMessages.vue";
const app = createApp({});
app.component("chat-form", ChatForm);
app.component("chat-messages", ChatMessages);
app.mount("#app");

//app and el already exists.
// app = new Vue({
//     el: "#app",
//     //Store chat messages for display in this array.
//     data: {
//         messages: [],
//     },
//     //Upon initialisation, run fetchMessages().
//     created() {
//         this.fetchMessages();
//     },
//     methods: {
//         fetchMessages() {
//             //GET request to the messages route in our Laravel server to fetch all the messages
//             axios.get("/messages").then((response) => {
//                 //Save the response in the messages array to display on the chat view
//                 this.messages = response.data;
//             });
//         },
//         //Receives the message that was emitted from the ChatForm Vue component
//         addMessage(message) {
//             //Pushes it to the messages array
//             this.messages.push(message);
//             //POST request to the messages route with the message data in order for our Laravel server to broadcast it.
//             axios.post("/messages", message).then((response) => {
//                 console.log(response.data);
//             });
//         },
//     },
// });
