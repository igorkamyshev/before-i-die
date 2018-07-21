const isProd = process.env.NODE_ENV === 'production'
const isDev = !isProd

const TELEGRAM_BOT_TOKEN = process.env.TELEGRAM_BOT_TOKEN

module.exports = {
    isProd,
    isDev,
    TELEGRAM_BOT_TOKEN,
}
