import Head from 'next/head';

const Header = ( { language } ) => {
    return <>
        <Head>
            <title>{language.title}</title>
            <link rel="icon" href="/favicon.ico" />
        </Head>
    </>
}

export default Header;