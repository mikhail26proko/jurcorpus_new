import AdminLayout from './admin/Layout'
import AuthLayout from './auth/Layout'
import PublicLayout from './public/Layout'

import { SessionProvider } from "next-auth/react"
import { useRouter } from 'next/router';

const Layout = ( { children, session, language }) => {

    const router = useRouter();
    const rout = router.pathname.split('/')[1];

    if (rout == 'auth') {
        return <>
            <SessionProvider session={session}>
                <AuthLayout>
                    { children }
                </AuthLayout>
            </SessionProvider>
        </>
    } else {
        if (rout == 'admin') {
            return <>
                <SessionProvider session={session}>
                    <AdminLayout>
                        { children }
                    </AdminLayout>
                </SessionProvider>
            </>
        } else {
            return <>
                <PublicLayout
                    language={language}
                >
                    {children}
                </PublicLayout>
            </>
        }
    }
}

export default Layout;
