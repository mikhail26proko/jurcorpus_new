import AdminMenu from './menu/Menu';
import Header from './Header'
import styles from './../../styles/admin/Layout.module.scss'

const Layout = ( { children } ) => {
    return <>
        <Header/>
        <div className={styles.pageContainer}>
            <AdminMenu/>
            { children }
        </div>
    </>
}

export default Layout;
