import Header from './Header'
import Menu from './menu/Menu'
import styles from './../../styles/public/Layout.module.scss'

const Layout = ( { children, language } ) => {
    return <>
        <Header
            language={language}
        />
        <div className={styles.pageContainer}>
            <Menu
                language={language}
            />
            { children }
        </div>
    </>
}

export default Layout;
