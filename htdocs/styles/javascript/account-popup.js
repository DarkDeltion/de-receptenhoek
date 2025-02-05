function displayMessage() {
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    const message = urlParams.get('message');

    if (status && message) {
        const decodedMessage = decodeURIComponent(message.replace(/_/g, ' '));
        const messageDiv = document.getElementById('message');
        messageDiv.textContent = decodedMessage;
        messageDiv.style.display = 'block';

        // Styling op basis van de status
        if (status === 'error') {
            messageDiv.style.color = 'red';
            messageDiv.style.backgroundColor = '#f8d7da'; // Lichtroze achtergrond voor error
            messageDiv.style.border = '1px solid #f5c6cb'; // Fijne border voor error
        } else if (status === 'success') {
            messageDiv.style.color = 'green';
            messageDiv.style.backgroundColor = '#d4edda'; // Lichtgroene achtergrond voor succes
            messageDiv.style.border = '1px solid #c3e6cb'; // Fijne border voor succes
        }
    }
}

window.onload = displayMessage;
