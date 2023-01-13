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
}

module.exports = nextConfig
