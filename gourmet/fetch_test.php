<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>test</title>
  <!-- <script src="fetch_test.js"></script> -->
</head>

<body>
  <div class="Container">
    <button class="btn" id="start">start</button>
    <script>
      const start = document.getElementById('start');
      start.addEventListener('click', () => {
        const postData = new FormData; // フォーム方式で送る場合
        postData.set('firstNum', 30); // set()で格納する
        postData.set('lastNum', 40);

        const data = {
          method: 'POST',
          body: postData
        };

        fetch('fetch_test.php', data)
          .then((res) => res.text())
          .then(console.log);
      });
    </script>
  </div>

  <?php
echo 'Fetchで受け取った値：'.$_POST['firstName']; ?>
<!-- echoで表示はできないけど、console.logにはでているので、値としては扱えそう -->
<?php
echo $_POST['firstNum'] * $_POST['lastNum'];
?>
</body>

</html>