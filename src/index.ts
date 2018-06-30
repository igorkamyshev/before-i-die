import Server from '@bid/Server'

const PORT = 8080

const start = async () => {
    Server.start(PORT)

    // tslint:disable-next-line:no-console
    console.log(`App started @ ${PORT}`)
}

start()
