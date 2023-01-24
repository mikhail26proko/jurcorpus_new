import Layout from '../components/Layout'
import AdminLayout from '../components/admin/Layout'
import AuthLayout from '../components/auth/Layout'

import { SessionProvider } from "next-auth/react"
import { useRouter } from 'next/router';
import { lang } from "../locales/lang"

import '../styles/globals.scss'

function JurCorpusApp({ Component, pageProps:{session, ...pageProps} }) {

  const router = useRouter();
  const language = router.locale
    ? lang[router.locale] : lang.ru;

      return <>
        <Layout
          language={language}
        >
          <Component 
            {...pageProps}
            language={language}
          />
        </Layout>
      </>
}

export default JurCorpusApp;
