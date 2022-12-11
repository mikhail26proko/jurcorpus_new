import { getCookie, hasCookie } from 'cookies-next';

async function getFetcher({url}) {
    if (await hasCookie('acess_token', { req, res }))
    {
        const token = await getCookie('acess_token', { req });

        const myHeaders = new Headers();

        myHeaders.append("Authorization", `Bearer ${token}`)
        myHeaders.append("Content-Type", "application/json");

        var requestOptions = {
            method: 'GET',
            headers: myHeaders,
            redirect: 'follow'
        };
        
        const res = await fetch(`http://${API_URL}/api/${url}`,requestOptions)
        const leads = await res.json()
        return { props: { leads } }
    }
}


export const adminUtils = {
    getFetcher,

}