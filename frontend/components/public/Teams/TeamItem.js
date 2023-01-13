import Image from 'next/image'

import styles from '../../../styles/public/Team.module.scss'

const TeamItem = ( { item } ) => {
    return <>
        <div
            key = {item.id}
            className={styles.TeamItem}
        >
            <div className={styles.avatar}>
                <Image
                    src="/images/lawer.jpg"
                    width={300}
                    height={400}
                    alt="avatar"
                >
                </Image>
            </div>
            <div>
                <h3 className={styles.names}>
                    { item.fio }
                </h3>
                <h6 className={styles.title}>
                    <i>{item.jobtitle}</i>
                </h6>
                    <br />
                <div className={styles.description} dangerouslySetInnerHTML={{__html:item.description}}>
                    
                </div>
            </div>
        </div>
    </>
}

export default TeamItem;