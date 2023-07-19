import Head from 'next/head';

const Header = ( { language } ) => {
    return <>
        <Head>
            <title>{language.title}</title>
            <link rel="icon" href="/favicon.ico" />
            <meta name="title" content={language.title}></meta>
            <meta name="og:title" content={language.title}></meta>
            <meta name="description" content={language.description}></meta>
            <meta name="og:description" content={language.description}></meta>
            <meta name="keywords" content={language.keywords}></meta>
            <meta name="og:keywords" content={language.keywords}></meta>
        </Head>
    </>
}

export default Header;