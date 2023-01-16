import Image from 'next/image'

import styles from '../../../styles/public/Team.module.scss'

const TeamItem = ( { item } ) => {
    return <>
        <div
            key = {item.id}
            className={styles.TeamItem}
        >
            <div className={styles.person}>
                <h3 className={styles.names}>
                    { item.fio }
                </h3>
                <h4 className={styles.title}>
                    {item.jobtitle}
                </h4>
            </div>
            <div className={styles.personInfo}>
                <div className={styles.avatar}>
                    <div className={styles.picture}>
                        <Image
                            src={"/images/lawyers"+(item.avatar ?? "/lawyer.jpg")}
                            loading="lazy"
                            width={300}
                            height={400}
                            alt="avatar"
                        >
                        </Image>
                    </div>
                </div>
                <div className={styles.description}>
                    <div dangerouslySetInnerHTML={{__html:item.description}}></div>
                </div>
            </div>
            
        </div>
    </>
}

export default TeamItem;