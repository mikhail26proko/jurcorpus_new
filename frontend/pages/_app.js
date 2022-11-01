import Layout from '../components/public/Layout'
import AdminLayout from '../components/admin/Layout'

import { SessionProvider } from "next-auth/react"
import { useRouter } from 'next/router';
import { lang } from "../locales/lang"

import '../styles/globals.scss'

function PublicPages({ Component, pageProps:{session, ...pageProps} }) {

  const router = useRouter();
  const language = router.locale
    ? lang[router.locale] : lang.ru;

  const rout = router.pathname.split('/')[1];

  if (rout == 'auth'){
    return<>
      <SessionProvider session={session}>
        <Component 
          {...pageProps}
        />
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

export default PublicPages;
