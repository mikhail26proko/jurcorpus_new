import Router from 'next/router'
import { setCookie} from 'cookies-next';

export const API_URL = process.env.NEXT_PUBLIC_BACK_URL;

export default async function login(username, password) {
    const data = {
        "login":username,
        "password":password,
    }

    await fetch(`${API_URL}/api/login_check`,{
            headers: new Headers({
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }),
            method: 'POST',
            body: JSON.stringify(data),
        })
        .then(res=>res.json())
        .then(result=>{
            const accessToken = result.token;
            const bearer = `Bearer ${accessToken}`;
            setCookie("Bearer", bearer , {maxAge:3600});
            Router.push(`/admin/`)
        })
}

export const auth = {
    login,
};