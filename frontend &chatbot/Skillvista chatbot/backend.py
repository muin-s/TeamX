# Import necessary libraries
from flask import Flask, request, jsonify

app = Flask(__name__)

# Dictionary to store predefined questions and answers
qa_pairs = {
    "Good day! It's great to have you here. I'm excited to help you with your software development journey. To get started, could you share a bit about your qualifications and your background in technology?":
        "Hi! Thanks for having me. I have a bachelor's degree in computer science, and I've been working in the industry for about two years now. I mainly focus on web development using JavaScript and Python.",
    
    "That's excellent. It sounds like you have a solid foundation. Can you tell me about any specific projects or technologies you've worked with recently?":
        "Sure! In my current role, I've been involved in developing e-commerce websites using React for the frontend and Django for the backend. I've also worked on integrating payment gateways and optimizing website performance.",
    
    "Impressive! Given your experience, you'd be eligible for various roles in web development and backend engineering. Roles such as Full Stack Developer, Backend Developer, or even a specialized Frontend Developer could be great fits for you. Now, let's talk about enhancing your skills. Considering your background, diving deeper into frameworks like React and Django would be beneficial. Additionally, exploring containerization with technologies like Docker and understanding cloud platforms like AWS or Azure could open up more opportunities for you. How do you feel about expanding your expertise in these areas?":
        "That sounds like a good plan. I haven't worked much with Docker or cloud platforms, so I'm eager to learn more about them.",
    
    "Excellent! Docker and cloud platforms are valuable skills in the current tech landscape. For Docker, you can start with understanding containerization concepts and gradually move to practical implementation. As for cloud platforms, AWS and Azure offer extensive documentation and hands-on labs for learning. Consider also looking into microservices architecture, as it aligns well with your current experience and will add another layer to your skill set. Keep exploring and building projects to reinforce your learning. If you encounter any challenges or have questions, don't hesitate to reach out. Happy coding!":
        "Thank you! I'll definitely explore Docker, cloud platforms, and microservices. If I have any questions, I'll be sure to ask. Happy coding!",
    
    "Hi":
        "Hello there! It's a pleasure to have you. How can I assist you today?",
    
    "I've been working in the software industry for about two years now. I have a bachelor's degree in computer science, and my focus has been on web development using JavaScript and Python.":
        "That's fantastic! It sounds like you have a strong foundation. Can you tell me more about the projects or technologies you've been working on recently?",
    
    "Certainly! In my current role, I've been involved in developing e-commerce websites using React for the frontend and Django for the backend. I've also worked on integrating payment gateways and optimizing website performance.":
        "Impressive background! With your experience, you're eligible for various roles in web development and backend engineering. Positions like Full Stack Developer, Backend Developer, or even a specialized Frontend Developer could be great fits for you. Now, let's discuss expanding your skill set. Given your current expertise, delving deeper into frameworks like React and Django would be beneficial. Additionally, consider exploring containerization with technologies like Docker and understanding cloud platforms such as AWS or Azure. How do you feel about broadening your knowledge in these areas?",
    
    "That sounds like a good plan. I haven't worked much with Docker or cloud platforms, so I'm eager to learn more about them.":
        "Great! Docker and cloud platforms are valuable skills in the current tech landscape. Start by understanding containerization concepts and gradually move to practical implementation for Docker. For cloud platforms like AWS and Azure, there are extensive documentation and hands-on labs available for learning. Also, consider looking into microservices architecture, as it aligns well with your current experience and adds another layer to your skill set. Keep exploring and building projects to reinforce your learning. If you run into any challenges or have questions, feel free to reach out. Happy coding!"
}

@app.route('/api/chat', methods=['POST'])
def get_chatbot_response():
    user_input = request.json['userInput']

    # Check if the user input matches any predefined questions
    if user_input in qa_pairs:
        response = {"response": qa_pairs[user_input]}
    else:
        response = {"response": "I'm not sure how to respond to that."}

    return jsonify(response)

if __name__ == '__main__':
    app.run(debug=True)
