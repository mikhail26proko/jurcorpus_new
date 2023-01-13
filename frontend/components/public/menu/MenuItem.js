import Link from 'next/link';
import style from '../../../styles/public/Layout.module.scss'

const MenuItem = ( { menuItem } ) => {
    return <>
        <Link
            href={ menuItem.k }
        >
            <div className={ style.menuItemContainer }>
                { menuItem.v }
            </div>
        </Link>
    </>
}

export default MenuItem;