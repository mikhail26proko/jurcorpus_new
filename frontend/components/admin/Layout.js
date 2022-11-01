import styles from './../../styles/admin/Layout.module.scss'

const Layout = ( { children } ) => {
    return <>
        <div className={styles.pageContainer}>
            {/* <Menu
            /> */}
            { children }
        </div>
    </>
}

export default Layout;
