import Link from 'next/link';
import styles from './../../../styles/public/Layout.module.scss'

const AdminMenuItem = ( {menuItem} ) => {

    return <>
        <div className={ styles.menuItemContainer }>
            <Link 
                href={`/admin${menuItem.k}`}
                title={menuItem.l}
            >
                <div>
                    {menuItem.v}
                </div>
            </Link>
        </div>
    </>
}

export default AdminMenuItem;