import style from '../../../styles/public/Layout.module.scss'
import MenuIcon from '@mui/icons-material/Menu';

import * as React from 'react';
import Link from 'next/link';

import Button from '@mui/material/Button';
import Menu from '@mui/material/Menu';
import MenuItem from '@mui/material/MenuItem';

const MobileMenu = ( { language, menu } ) => {

  const [anchorEl, setAnchorEl] = React.useState(null);
  const open = Boolean(anchorEl);
  const handleClick = (event) => {
    setAnchorEl(event.currentTarget)
  };
  const handleClose = () => {
    setAnchorEl(null);
  };

  return <>
    <div className={style.mobileMenuContainer}>
      <Button
        id="basic-button"
        aria-controls={open ? 'basic-menu' : undefined}
        aria-haspopup="true"
        aria-expanded={open ? 'true' : undefined}
        onClick={handleClick}
      >
        <span className={style.mobileMenuText}>
          <h3>
            {language.menuText}
          </h3>
        </span>

        <MenuIcon sx={{ color: "#900000"}}/>
      </Button>
      <Menu
        id="basic-menu"
        anchorEl={anchorEl}
        open={open}
        onClose={handleClose}
        MenuListProps={{
          'aria-labelledby': 'basic-button',
        }}
      >
        { menu?.map( ( menuItem, index ) => (
            <Link key={index} href={ menuItem.k } >
              <MenuItem onClick={handleClose}>
                { menuItem.v }
              </MenuItem>
            </Link>
          ))
        }
      </Menu>
    </div>
  </>
}

export default MobileMenu;