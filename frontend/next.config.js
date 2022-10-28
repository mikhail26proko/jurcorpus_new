/** @type {import('next').NextConfig} */
const nextConfig = {
  // reactStrictMode: true,
  swcMinify: true,
  i18n: {
    locales: ['ru', 'en', 'ua'],
    defaultLocale: 'ru',
  },
  trailingSlash: true,
}

module.exports = nextConfig
