import {useState} from 'react';

import Department from '../../components/public/Teams/Department'

import company from '../../public/files/departments.json'

import styles from '../../styles/public/Team.module.scss'

export const API_URL = process.env.NEXT_PUBLIC_BACK_URL;

export default function Team({ language }) {

    const departments = company.data

    const [expanded, setExpanded] = useState('panel01');

    const handleChange = (panel) => (event, isExpanded) => {
        setExpanded(isExpanded ? panel : false);
    };


    return <>
        <div className={styles.TeamContainer}>
            <div className={styles.TeamTitle}>
                <h2>
                    {language.team.team}
                </h2>
            </div>
            <div className={styles.TeamBoard}>
                {departments?.map((item, index) => (
                    <Department
                        key={index}
                        item={item}
                        isExpanded={expanded === ('panel'+item.id)}
                        handle={handleChange('panel'+item.id)}
                    >
                    </Department>
                ))}
            </div>
        </div>
    </>
}

// export async function getServerSideProps({ req, res }){

//     const myHeaders = new Headers();

//     myHeaders.append("Content-Type", "application/json");

//     var requestOptions = {
//         method: 'GET',
//         headers: myHeaders,
//         redirect: 'follow'
//     };

//     const resp = await fetch(`http://${API_URL}/api/user/public`,requestOptions)
//     const team = await resp.json()

//     return { props: { team } }
// }