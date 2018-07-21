const express = require('express')

const app = express()
const port = 8080

app.get('/', (_, res) => {
  res.send('Hello!')
})

app.listen(port)
