const securityHeaders = [
  {
    key: 'X-DNS-Prefetch-Control',
    value: 'on'
  },
  {
    key: 'Strict-Transport-Security',
    value: 'max-age=63072000; includeSubDomains; preload'
  },
  {
    key: 'Cache-Control',
    value: 'public, max-age=31536000, immutable'
  }
]

const nextConfig = {
  reactStrictMode: true,
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

  //optimization
  poweredByHeader: false,

  async headers() {
    return [
      {
        // Apply these headers to all routes in your application.
        source: '/',
        headers: securityHeaders,
      },
    ]
  },
}

module.exports = nextConfig
