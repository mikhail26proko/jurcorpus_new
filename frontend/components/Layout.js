import PublicLayout from './public/Layout'

import { SessionProvider } from "next-auth/react"
import { useRouter } from 'next/router';

const Layout = ( { children, session, language }) => {

    const router = useRouter();
    const rout = router.pathname.split('/')[1];
    return <>
        <PublicLayout
            language={language}
        >
            {children}
        </PublicLayout>
    </>
}

export default Layout;
