const express = require('express');
const fs = require('fs');
const app = express();
app.use(express.static('public'));
app.use(express.json()); // for parsing application/json
app.use((req, res, next) => {
  res.header('Access-Control-Allow-Origin', '*');
  next();
});
app.post('/add-new.js', (req, res) => {
  const data = req.body;
  let oldData = require('./example.json');
  oldData[sessionStorage.getItem('class')]["students"][sessionStorage.getItem('student')]["kurse"] = data;
  fs.writeFile('example.json', JSON.stringify(oldData, null, 2), 'utf8', function (err) {
    if (err) throw err;
    console.log('Saved!');
  });
  res.send('Data has been written');
});

app.listen(3000, () => {
  console.log('Server is running on port 3000');
});
