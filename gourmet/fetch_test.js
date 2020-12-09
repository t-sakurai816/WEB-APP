start.addEventListener('click', () => {
  const postData = new FormData; // フォーム方式で送る場合
  postData.set('firstName', 'hoge'); // set()で格納する
  postData.set('lastName', 'fuga');

  const data = {
    method: 'POST',
    body: postData
  };

  fetch('fetch_test.php', data)
    .then((res) => res.text())
    .then(console.log);
});