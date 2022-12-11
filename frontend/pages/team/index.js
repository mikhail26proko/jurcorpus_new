import TeamSlider from './../../components/public/Team/TeamSlider'

import styles from '../../styles/public/Team.module.scss'

export const API_URL = process.env.NEXT_PUBLIC_BACK_URL;

export default function Team({ language, team }) {

    console.log(team)

    return <>
        <div className={styles.TeamContainer}>
            <div className={styles.TeamTitle}>
                <h2>
                    {language.team.team}
                </h2>
            </div>
            <div className={styles.TeamBoard}>
                <TeamSlider
                    team={team}
                />
            </div>
        </div>
    </>
}

export async function getServerSideProps({ req, res }){

    const myHeaders = new Headers();

    myHeaders.append("Content-Type", "application/json");

    var requestOptions = {
        method: 'GET',
        headers: myHeaders,
        redirect: 'follow'
    };

    const resp = await fetch(`http://${API_URL}/api/user/public`,requestOptions)
    const team = await resp.json()

    return { props: { team } }
}