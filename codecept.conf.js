exports.config = {
  tests: './*_test.js',
  output: './output',
  helpers: {
    Puppeteer: {
      url: 'https://hetas.test'
    }
  },
  include: {},
  bootstrap: null,
  mocha: {},
  name: 'hetas-crm-complaints'
}