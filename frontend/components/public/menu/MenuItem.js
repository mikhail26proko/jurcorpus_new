import Link from 'next/link';
import { useRouter } from 'next/router'
import style from '../../../styles/public/Layout.module.scss'

const MenuItem = ( { menuItem } ) => {
    const router = useRouter()

    const isCurrent = router.pathname === menuItem.k

    const styler = isCurrent ? style.menuItemContainerActive : style.menuItemContainer;

    return <>
        <Link
            href={ menuItem.k }
        >
            <div className={ styler }>
                { menuItem.v }
            </div>
        </Link>
    </>
}

export default MenuItem;