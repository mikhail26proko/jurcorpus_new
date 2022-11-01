import * as React from 'react';
import NextAuth from "next-auth"
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
        // console.log("Данные входа", credentials)
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
          return data.token
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
      maxAge: 3600,
    },

    pages: {
      signIn: '/auth/signin',
      signOut: '/auth/signout',
    },

    debug:true,

  })
  
}