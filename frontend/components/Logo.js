import style from './../styles/public/Layout.module.scss'

import Image from 'next/image'

const Logo = () => {
    return <>
      <div className={style.logotype}>
        <Image
          src="/images/logo.png"
          width={320}
          height={100}
          alt="Logotype"
        />
      </div>
    </>
}

export default Logo;