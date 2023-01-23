import style from '../../../styles/public/Layout.module.scss'

import MenuItem from "./MenuItem"
import MobileMenu from "./MobileMenu"
import Logo from "../../Logo"

const Menu = ( { language } ) => {

  const menu = Array.from(language.menu ?? [])

  return <>
    <div className = { style.menuContainer }>
      <div className = { style.logo }>
        <Logo/>
      </div>
      <div className={style.mobileMenu}>
        <MobileMenu
          language={language}
          menu = { menu }
        />
      </div>
      { menu?.map( ( menuItem, index ) => (
          <MenuItem
            key={index}
            menuItem = { menuItem }
          />
        ))
      }
    </div>
  </>
}

export default Menu;