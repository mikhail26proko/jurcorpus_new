import * as React from 'react';
import { useState } from "react";
import { signIn } from "next-auth/react"

import Button from '@mui/material/Button';
import TextField from '@mui/material/TextField';
import Logotype from '../../components/Logo'

import styles from '../../styles/public/Auth.module.scss'

export default function SignIn(csrfToken) {

    const [login, setLogin] = useState("");
    const [password, setPassword] = useState("");

    return <>
        <div className={styles.SigninContainer}>
            <div className={styles.SigninForm}>
                <form method="post" action="/api/auth/callback/credentials">
                    <input name='csrfToken' type='hidden' defaultValue={csrfToken}/>
                    <div className={styles.Logo}>
                        <Logotype/>
                    </div>
                    <div className={styles.TextBlock}>
                        <h3>
                            Авторизация
                        </h3>
                    </div>
                    <div className={styles.LoginBlock}>
                        <TextField
                            required
                            label="Логин"
                            name="username"
                            variant="standard"
                            className={styles.LoginTextField}
                            autoComplete="off"
                            // autoComplete="current-login"
                            autoFocus={true}
                            onChange={(e) => setLogin(e.target.value)}
                        ></TextField>
                    </div>
                    <div className={styles.PasswordBlock}>
                        <TextField
                            required
                            label="Пароль"
                            name="password"
                            variant="standard"
                            type="password"
                            autoComplete="off"
                            className={styles.PasswordTextField}
                            // autoComplete="current-password"
                            onChange={(e) => setPassword(e.target.value)}
                        ></TextField>
                    </div>
                    <div className={styles.SubmitBlock}>
                        <Button
                            variant="contained"
                            className={styles.SubmitButton}
                            onClick={() => signIn("credentials",{login, password, callbackUrl: "/admin"})}
                        >
                            Вход
                        </Button>
                    </div>
                </form>
            </div>
        </div>
    </>
}