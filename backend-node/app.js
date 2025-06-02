const express = require('express')
const cors = require('cors')

const app = express()

app.use(express.json())

app.use(cors({
  origin: 'http://localhost:5173',
  credentials: true,
}))

app.get('/api/hello', (req, res) => {
  res.json({ message: 'Hello from Node.js backend' })
})

app.get('/api/test', (req, res) => {
  res.json({ message: 'Backend Node.js tersambung!' });
});


app.listen(3000, () => {
  console.log('Server berjalan di http://localhost:3000')
})
