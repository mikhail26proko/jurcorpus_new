import Layout from '../components/public/Layout'
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

  const rout = router.pathname.split('/')[1];

  console.log(rout)

  if (rout == 'auth'){
    return<>
      <SessionProvider session={session}>
        <AuthLayout>
          <Component 
            {...pageProps}
          />
        </AuthLayout>
      </SessionProvider>
    </>
  } else {
    if (rout == 'admin'){
      return<>
          <SessionProvider session={session}>
            <AdminLayout>
              <Component 
                {...pageProps}
              />
            </AdminLayout>
          </SessionProvider>
      </>
    } else {
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
  }
  
}

export default JurCorpusApp;
