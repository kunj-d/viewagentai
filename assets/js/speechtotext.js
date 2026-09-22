$(document).ready(function () {


  if ("webkitSpeechRecognition" in window) {
    // Initialize webkitSpeechRecognition
    let speechRecognition = new webkitSpeechRecognition();

    // String for the Final Transcript
    let final_transcript = "";

    // Set the properties for the Speech Recognition object
    speechRecognition.continuous = true;
    speechRecognition.interimResults = true;
    // speechRecognition.lang = document.querySelector("#select_dialect").value;

    // Callback Function for the onStart Event
    speechRecognition.onstart = () => {
      // Show the Status Element
    //   document.querySelector("#listing").style.display = "block";
      //document.querySelector("#myImage").src = "<?= $this->config->item('assetsBasePath') ?>assets/images/microphone1.png";
    };
    speechRecognition.onerror = () => {
      // Hide the Status Element
    //   document.querySelector("#listing").style.display = "none";
      //document.querySelector("#myImage").src = "<?= $this->config->item('assetsBasePath') ?>assets/images/mic.png";
    };
    speechRecognition.onend = () => {
      // Hide the Status Element
    //   document.querySelector("#listing").style.display = "none";
      //document.querySelector("#myImage").src = "<?= $this->config->item('assetsBasePath') ?>assets/images/mic.png";
    };

    speechRecognition.onresult = (event) => {
      // Create the interim transcript string locally because we don't want it to persist like final transcript
      let interim_transcript = "";

      // Loop through the results from the speech recognition object.

      console.log(final_transcript);
      for (let i = event.resultIndex; i < event.results.length; ++i) {
        // If the result item is Final, add it to Final Transcript, Else add it to Interim transcript
        if (event.results[i].isFinal) {
          final_transcript += event.results[i][0].transcript;
        } else {
          // interim_transcript += event.results[i][0].transcript;
          console.log('interim_transcript else part');
        }
      }
      // Set the Final transcript and Interim transcript.
      document.querySelector("#inputText").value  = final_transcript;
      // document.querySelector("#interim").innerHTML = interim_transcript;
    };
    // Set the onClick property of the start button
     var count = 1;
    $(document).on('click','#mic', function () {
         count = count +1;
        console.log(count);
        if(count % 2 == 0){
            final_transcript = "";
            speechRecognition.start();
        }else{
            final_transcript = "";
             speechRecognition.stop();
        }
      });
    //   $(document).on('mouseup','#mic', function () {
    //     final_transcript = "";
    //     speechRecognition.stop();
    //   });
    // $(document).on('mousedown','#mic', function () {
    //     speechRecognition.start();
    //   });
    //   $(document).on('mouseup','#mic', function () {
    //     final_transcript = "";
    //     speechRecognition.stop();
    //   });
    function checkEnter(e){
      var code = e.keyCode || e.which;
      if (code == 13) {
        speechRecognition.stop();
      }
     }
     document.querySelector('#inputText').onkeypress = checkEnter;
    // document.querySelector("#micOn").onclick = () => {

    //   // Start the Speech Recognition
    // };
    // Set the onClick property of the stop button
    // document.querySelector("#stop").onclick = () => {
    //   // Stop the Speech Recognition
    // };

    // document.querySelector("#clear").onclick = () => {
    //   document.querySelector("#inputText").value = '';

    // }
  } else {
    console.log("Speech Recognition Not Available");
  }
})