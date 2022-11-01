import { signOut } from "next-auth/react"

import Button from '@mui/material/Button';

import styles from '../../styles/public/Auth.module.scss'

export default function Signout() {

    return <>
        <Button
            variant="contained"
            className={styles.SubmitButton}
            onClick={() => signOut('Credentials',{callbackUrl: "/auth/signin"})}
        >
            Выход
        </Button>
    </>
}