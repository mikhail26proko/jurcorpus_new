import Image from 'next/image'

import styles from '../../../styles/public/Team.module.scss'

const TeamItem = ( { item } ) => {
    return <>
        <div className={styles.TeamItem}>
            <div>
                {/* <Image
                    src = {item.}
                /> */}
            </div>
            <h4>
                { item.fio }
            </h4>
                <br />
            <h5>
                {item.jobTitle}
            </h5>
                <br />
            <ul className={styles.Description}>
                {item.description.map((description, index)=>(
                    <li key={index} className={styles.ItemDescription}>
                        <span className={styles.ItemDescriptionText}>
                            {description}
                        </span>
                    </li>
                ))}
            </ul>
            
        </div>
    </>
}

export default TeamItem;