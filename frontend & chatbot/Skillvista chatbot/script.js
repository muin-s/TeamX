var conversation = [];

function sendMessage() {
    var userInput = document.getElementById("userInput").value;
    if (userInput !== "") {
        appendMessage("User", userInput);

        // Simulate a conversation with SkillVista
        simulateSkillVistaResponse(userInput);

        document.getElementById("userInput").value = ""; // Clear input field
    }
}

function simulateSkillVistaResponse(userInput) {
    // Add user input to the conversation history
    conversation.push({ sender: "User", message: userInput });

    // Simulate SkillVista responses based on the conversation history
    var SkillVistaResponse = getSkillVistaResponse();
    appendMessage("SkillVista", SkillVistaResponse);
}

function getSkillVistaResponse() {
    // Use the conversation history to generate SkillVista responses
    var lastUserMessage = conversation.length > 0 ? conversation[conversation.length - 1].message.toLowerCase() : "";

    // Define responses based on the last user message
    var responses = {
        "hello": "Hi there! How can I help you today?",
        "how are you": "I'm just a computer program, but thanks for asking!",
        "goodbye": "Goodbye! Feel free to come back anytime.",
        // Add more predefined responses as needed
    };

    // Check if there is a predefined response for the last user message
    var response = responses[lastUserMessage];

    // If there's no predefined response, provide a default response
    return response ? response : "I'm not sure how to respond to that.";
}

function appendMessage(sender, message) {
    var chatBox = document.getElementById("chatBox");
    var messageElement = document.createElement("div");
    messageElement.innerHTML = "<strong>" + sender + ":</strong> " + message;
    chatBox.appendChild(messageElement);
    chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll to the bottom
}
