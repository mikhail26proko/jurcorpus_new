import axios from 'axios';

export const API_URL = process.env.NEXT_PUBLIC_BACK_URL;

export default axios.create({
    baseURL: API_URL,
    withCredentials: true,
    responseEncoding: 'utf8',
    
});