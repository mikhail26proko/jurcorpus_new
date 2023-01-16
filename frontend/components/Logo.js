import style from './../styles/public/Layout.module.scss'

import Link from 'next/link';
import Image from 'next/image'

const Logo = () => {
    return <>
      <Link
        href={ '/' }
      >
        <div className={style.logotype}>
          <Image
            src="/images/logo.png"
            width={320}
            height={100}
            alt="Logotype"
          />
        </div>
      </Link>
    </>
}

export default Logo;