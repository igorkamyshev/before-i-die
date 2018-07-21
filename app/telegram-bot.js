const TelegramBot = require('node-telegram-bot-api')
const { TELEGRAM_BOT_TOKEN } = require('./env')

const bot = new TelegramBot(TELEGRAM_BOT_TOKEN, { polling: true })

const send = (chatId, message) => bot.sendMessage(chatId, message, { parse_mode: 'Markdown' })

const start = () => {
  bot.onText(/\/start/, async (msg) => {
    await send(msg.chat.id, 'Привет. Отправь мне свои мысли, я анонимно опубликую их.')
  })
}

module.exports = {
  start,
}
