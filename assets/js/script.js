 $(document).ready(function() {
    // Header JavaScript
    $('.side-nav-toggle').click(function() {
        $('.container-wrapper').toggleClass('container-open');
        $('.sidebar').toggleClass('sidebar-show');
        $('.sidebar').toggleClass('highlight');
        $('input.menu-title').toggleClass('d-none');
    });
    $('.side-nav-toggles').click(function() {
        $('.sidebar').toggleClass('sidebar-show1');
    });
    $(".close-sidemenu .close-btn a").click(function(event) {
        event.preventDefault();
    });
    
    // selectpicker JavaScript
    setTimeout(function() {
        // Find all <select> elements inside .dataTables_wrapper and initialize Bootstrap's selectpicker for them
        jQuery('.dataTables_wrapper select,select').selectpicker();
         $('.typeSelect').selectpicker('destroy');
    }, 2000); // 500 milliseconds = 0.5 second

    // for autocomplete off for all inputs
    $('input,textarea').attr('autocomplete','off');
});

// Tags Input Js 
$(function() {
    $('#primary').tagsInput({
        width: 'auto'
    });
});

// Play-Stop Toogle

$('.radio-toggle .playButton').click(function(e) {
    e.preventDefault();
    $(this).parent().siblings().children().children('i').removeClass('icon-voice-pause').addClass('icon-play');
    $(this).children('i').toggleClass('icon-play').toggleClass('icon-voice-pause');
});

//clear Text on Btn Click
function clearTextArea() {
    document.textform.textarea.value = '';
}

//count Number Of Characters

const messageEle = document.getElementById('comment');
const counterEle = document.getElementById('tts_text_used');

// messageEle.addEventListener('input', function(e) {

//     const target = e.target;

//     // Get the `maxlength` attribute
//     const maxLength = target.getAttribute('maxlength');

//     // Count the current number of characters
//     const currentLength = target.value.length;

//     counterEle.innerHTML = `${currentLength}`;
//     if ($(this).val().length >= 10000) {
//         alert('Character limit is 10000');
//     }

// });

//add text