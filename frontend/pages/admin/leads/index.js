import { hasCookie, getCookie } from 'cookies-next';

export const API_URL = process.env.NEXT_PUBLIC_BACK_URL;
// export const secret = process.env.NEXTAUTH_SECRET;

const Leads = ( { leads } ) => {
    return <>

    </>
}

export async function getServerSideProps({ req, res }){

    
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
        
        const resp = await fetch(`http://${API_URL}/api/lead/all`,requestOptions)
        const leads = await resp.json()
        return { props: { leads } }
    }
    const data = {}
    return {props: { data } }
}

export default Leads