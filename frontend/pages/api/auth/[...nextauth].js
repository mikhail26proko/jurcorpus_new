import * as React from 'react';
import NextAuth from "next-auth"
import { setCookie } from 'cookies-next';
import Credentials from 'next-auth/providers/credentials'

export const API_URL = process.env.NEXT_PUBLIC_BACK_URL;

export default async function auth(req, res) {
  const providers = [
    Credentials({
      name: "Credentials",
      credentials: {
        login: { label: 'login', type: 'text' },
        password: { label: 'password', type: 'password' },
      },
      async authorize(credentials, req) {
        const signInRequest = await fetch(`http://${API_URL}/api/login_check`,{
          headers:{
              'Accept': 'application/json',
              'Content-Type': 'application/json'
          },
          method: 'POST',
          body: JSON.stringify({
            "login": credentials.login,
            "password": credentials.password,
          }),
        })
        const data = await signInRequest.json();
        if (data && data.token){

          const userRequest = await fetch(`http://${API_URL}/api/user/current`,{
            headers:{
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                "Authorization": `Bearer ${data.token}`
            },
            method: 'GET',
          })
          setCookie('acess_token', data.token, {res, req, maxAge: 7200});
          const udata = await userRequest.json();
          return await udata
        }
        else{
          throw new Error(data);
        }
      }

    }),
  ];

  return await NextAuth(req,res, {
    providers,
    secret: process.env.NEXTAUTH_SECRET,

    session: {
      strategy: "jwt",
      maxAge: 7200,
    },

    pages: {
      signIn: '/auth/signin',
      signOut: '/auth/signout',
    },

    callbacks:{
    },

    debug:true,

  })
  
}