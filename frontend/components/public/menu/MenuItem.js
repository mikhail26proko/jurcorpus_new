import Link from 'next/link';
import style from '../../../styles/public/Layout.module.scss'

const MenuItem = ( { menuItem } ) => {
    return <>
        <div className={ style.menuItemContainer }>
            <Link
                href={ menuItem.k }
            >
                { menuItem.v }
            </Link>
        </div>
    </>
}

export default MenuItem;