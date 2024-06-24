<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="../../public/css/style.css">
  <link rel="stylesheet" href="../../public/css/contact.css">
  <link rel="stylesheet" href="../../public/css/footer.css">
</head>
<body>
<?php include_once "../app/views/constant/header.php"; ?>

<div class="containerr">
  <span class="big-circle"></span>
  <img src="img/shape.png" class="square" alt="" />
  <div class="form">
    <div class="contact-info">
      <h3 class="title">Let's get in touch</h3>
      <p class="text">
      We'd love to hear from you! Whether you have questions, feedback, or just want to say hello, our team is here to assist. Reach out via the contact form or social media. Your satisfaction is our priority. Thank you!
      </p>

      <div class="info">
        <div class="information">
          <i class="fa-solid fa-location-dot fs-5 mx-2 mb-3"></i>
          <p>Sanepa, Lalitpur</p>
        </div>
        <div class="information">
          <i class="fa-solid fa-envelope fs-5 mx-2 mb-3"></i>
          <p>info@concursonaire.com</p>
        </div>
        <div class="information">
          <i class="fa-solid fa-phone fs-5 mx-2 mb-3"></i>
          <p>+977 - 9869723240</p>
        </div>
      </div>

      <div class="social-media">
        <p>Connect with us :</p>
        <div class="social-icons">
          <a href="#">
            <i class="text-white fab fa-facebook-f"></i>
          </a>
          <a href="#">
            <i class="text-white fab fa-twitter"></i>
          </a>
          <a href="#">
            <i class="text-white fab fa-instagram"></i>
          </a>
          <a href="#">
            <i class="text-white fab fa-linkedin-in"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="contact-form">
      <span class="circle one"></span>
      <span class="circle two"></span>

      <form action="/Concursonaire/public/info/contact" method="POST" autocomplete="off">
        <h3 class="title">Contact us</h3>

        <?php if (isset($_SESSION['user_id'])): ?>
          <div class="input-container textarea">
            <textarea name="message" class="input"></textarea>
            <label for="">Message</label>
            <span>Message</span>
          </div>
        <?php else: ?>
          <div class="input-container">
            <input type="text" name="username" class="input" />
            <label for="">Username</label>
            <span>Username</span>
          </div>
          <div class="input-container">
            <input type="email" name="email" class="input" />
            <label for="">Email</label>
            <span>Email</span>
          </div>
          <div class="input-container">
            <input type="tel" name="phone" class="input" />
            <label for="">Phone</label>
            <span>Phone</span>
          </div>
          <div class="input-container textarea">
            <textarea name="message" class="input"></textarea>
            <label for="">Message</label>
            <span>Message</span>
          </div>
        <?php endif; ?>

        <input type="submit" value="Send" class="button" />
      </form>
    </div>
  </div>
</div>

<script>
  const inputs = document.querySelectorAll(".input");

  function focusFunc() {
    let parent = this.parentNode;
    parent.classList.add("focus");
  }

  function blurFunc() {
    let parent = this.parentNode;
    if (this.value == "") {
      parent.classList.remove("focus");
    }
  }

  inputs.forEach((input) => {
    input.addEventListener("focus", focusFunc);
    input.addEventListener("blur", blurFunc);
  });
</script>
</body>
</html>
