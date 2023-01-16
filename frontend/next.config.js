const nextConfig = {
  // reactStrictMode: true,
  swcMinify: true,
  i18n: {
    locales: ['ru'],
    defaultLocale: 'ru',
  },
  trailingSlash: true,
  images: {
    deviceSizes: [640, 750, 828, 1080, 1200, 1920, 2048, 3840],
  },
  env:{
    API_URL:process.env.NEXT_PUBLIC_BACK_URL
  },
}

module.exports = nextConfig
