/** @type {import('next').NextConfig} */
const nextConfig = {
  // reactStrictMode: true,
  swcMinify: true,
  i18n: {
    locales: ['ru', 'en', 'ua'],
    defaultLocale: 'ru',
  },
  trailingSlash: true,
  env:{
    API_URL:process.env.NEXT_PUBLIC_BACK_URL
  },
  api: {
    bodyParser: false,
  },
}

module.exports = nextConfig
