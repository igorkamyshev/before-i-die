const express = require('express')
const telegramBot = require('./telegram-bot')

const app = express()
const port = 8080

app.get('/', (_, res) => {
  res.send('Hello!')
})

getLastMessages(100).then(r => console.log(r))

telegramBot.start()
app.listen(port)
