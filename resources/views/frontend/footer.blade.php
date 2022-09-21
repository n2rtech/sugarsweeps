<div class="footer-bg text-center" id="contact-section">
    <img src="{{ asset('assets/img/footer-dragon.png') }}" alt="Footer Dragon" class="img-responsive footer-dragon">
    <div class="container">
        <div class="social-info">
            <a href="#" target="_blank"><img src="{{ asset('assets/img/facebook-icon.png') }}" alt="Facebook" class="img-responsive"></a>
        </div>
        <div class="footer-info">
            <ul class="list-unstyled">
                <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                <li>|</li>
                <li><a href="{{ route('terms-and-conditions') }}">Terms and Conditions</a></li>
            </ul>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
            <p class="copy-right">© copyright <span>2022</span><a href="#"> dragonstakes.</a> all rights
                reserved</p>
        </div>
    </div>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="mdi mdi-arrow-up"></i></button>
    <script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  $('html,body').animate({ scrollTop: 0 }, 400);
  document.documentElement.scrollTop = 0;
}
</script>

</div>
