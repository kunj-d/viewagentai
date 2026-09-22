<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $this->config->item('productName') ?> | Voice Recognition Example</title>
</head>
<body>

<button id="startRecognition">Start Recognition</button>
<p id="output"></p>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
  const startRecognitionButton = document.getElementById('startRecognition');
  const outputElement = document.getElementById('output');
  
  // Check if the SpeechRecognition API is supported
  if ('SpeechRecognition' in window || 'webkitSpeechRecognition' in window) {
    const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();

    // Set the language for recognition
    recognition.lang = 'en-US';

    recognition.onstart = () => {
      outputElement.textContent = 'Listening...';
    };

    recognition.onresult = (event) => {
      const transcript = event.results[0][0].transcript;
      outputElement.textContent = `You said: ${transcript}`;
    };

    recognition.onerror = (event) => {
      outputElement.textContent = 'Error occurred in recognition: ' + event.error;
    };

    startRecognitionButton.addEventListener('click', () => {
      recognition.start();
    });
  } else {
    outputElement.textContent = 'Speech recognition is not supported in your browser.';
  }
});
</script>

</body>
</html>
