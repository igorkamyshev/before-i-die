const express = require('express')
const telegramBot = require('./telegram-bot')

const app = express()
const port = 8080

app.get('/', (_, res) => {
  res.send('Hello!')
})

telegramBot.start()
app.listen(port)
