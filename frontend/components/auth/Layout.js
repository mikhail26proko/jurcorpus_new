import Header from './Header'

const AuthLayout = ( { children } ) => {
    return <>
        <Header/>
        { children }
    </>
}

export default AuthLayout;
