const TelegramBot = require('node-telegram-bot-api')
const { TELEGRAM_BOT_TOKEN } = require('./env')

const TARGET_CHANNEL = '@before_i_die'

const bot = new TelegramBot(TELEGRAM_BOT_TOKEN, { polling: true })

const send = (chatId, message) => bot.sendMessage(chatId, message, { parse_mode: 'Markdown' })
const publish = request => send(TARGET_CHANNEL, request.text)
const response = (request, message) => send(request.chat.id, message)

const start = () => bot.on('message', req => (
  (req.text === '/start')
    ? response(req, 'Привет. Отправь мне свои мысли, я анонимно опубликую их.')
    : publish(req)
))

const getFeaturedMessage = () => bot.getChat(TARGET_CHANNEL)
  .then((chat) => {
    if (!chat.pinned_message) {
      throw Error('last message unavailable')
    }

    return chat.pinned_message.text
  })

const newPost = message => publish({ text: message })

module.exports = {
  start,
  getFeaturedMessage,
  newPost,
}
