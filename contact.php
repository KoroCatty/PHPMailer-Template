<?php
session_start();
?>

<?php include 'layout/header.php'; ?>


  <div class="contact">
    <div class="">
      <div>
        <h4>How to send mail in PHP using PHP Mailer</h4>
      </div>
    </div>
  </div>

  <div class="formContainer">
    <form action="sendmail.php" method="POST">

      <div class="eachForm">
        <label for="fullname">Full Name</label>
        <input type="text" name="fullname" id="fullname" required>
      </div>

      <div class="eachForm">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
      </div>

      <div class="eachForm">
        <label for="subject">Subject</label>
        <input type="text" name="subject" id="subject" required>
      </div>

      <div class="eachForm">
        <label for="message">Message</label>
        <textarea name="message" id="message" rows="3" required></textarea>
      </div>

      <div class="eachForm">
        <button name="submitContact" type="submit">Send Mail</button>
      </div>

    </form>
  </div>

  <script>
    const megText = "<?php echo $_SESSION['status'] ?? ''; ?>";
    if (msgText != '') {
      alert(msgText);
      <?php unset($_SESSION['status']); ?> // unset() は、PHP の関数で、指定された変数や配列の要素を削除
    }
  </script>

<?php include 'layout/footer.php'; ?>