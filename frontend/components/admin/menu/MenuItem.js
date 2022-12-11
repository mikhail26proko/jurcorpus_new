import Link from 'next/link';
import styles from './../../../styles/public/Layout.module.scss'

const AdminMenuItem = ( {menuItem} ) => {

    return <>
        
        <Link 
            href={`/admin${menuItem.k}`}
            title={menuItem.l}
        >
            <div className={ styles.menuItemContainer }>
                <div>
                    {menuItem.v}
                </div>
            </div>
        </Link>
    </>
}

export default AdminMenuItem;