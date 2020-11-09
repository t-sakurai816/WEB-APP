const data = {"name": "Tanaka"};

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
.then(json => {
  console.log('Success:', data);
  console.log('Success!!!:', json);
})
.catch((error) => {
  console.error('Error.....:', error);
});
