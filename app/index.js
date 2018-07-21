const express = require('express')
const telegramBot = require('./telegram-bot')

const app = express()
const port = 8080

app.get('/', (_, res) => {
  res.send('Hello!')
})

app.get('/message', (_, res) => {
  telegramBot.getLastMessage()
    .then(
        msg => {
            res.status(200)
            res.send(msg)
        },
        err => {
            response.status(500)
            res.send(err)
        },
    )
})

telegramBot.start()
app.listen(port)
