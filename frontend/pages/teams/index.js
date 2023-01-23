import {useState} from 'react';

import Team from '../../components/public/Teams/Team'

import company from '../../public/files/departments.json'
import styles from '../../styles/public/Team.module.scss'
export const API_URL = process.env.NEXT_PUBLIC_BACK_URL;

export default function Teams({ language }) {

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
                    <Team
                        key={index}
                        item={item}
                        isExpanded={expanded === ('panel'+item.id)}
                        handle={handleChange('panel'+item.id)}
                    >
                    </Team>
                ))}
            </div>
        </div>
    </>
}
