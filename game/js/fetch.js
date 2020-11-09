const data = { username: example };

fetch('https://webapp.massyu.net/php/test.php', {
  method: 'POST', // or 'PUT'
  mode: 'cors',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  },
  body: JSON.stringify(data),
})
.then(response => response.json())
.then(data => {
  console.log('Success:', data);
})
.catch((error) => {
  console.error('Error:', error);
});
