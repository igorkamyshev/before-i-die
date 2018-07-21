const bodyParser = require('body-parser')
const cors = require('cors')
const express = require('express')
const telegramBot = require('./telegram-bot')

const app = express()
const port = 8080

app.use(bodyParser.json())
app.use(cors())

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

app.post('/new', (req, res) => telegramBot.newPost(req.body.message)
  .then(
    () => res.status(200),
    () => res.status(500),
  )
  .then(
    () => res.send()
  )
)

telegramBot.start()
app.listen(port)
