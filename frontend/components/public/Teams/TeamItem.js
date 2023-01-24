import Image from 'next/image'

import styles from '../../../styles/public/Team.module.scss'

const TeamItem = ( { item } ) => {

    const isFully = item.description?.length > 250 ? true : false;
    const isEmpty = item.description?.length===undefined

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
            <div className={ isEmpty ? styles.personInfoNone : styles.personInfo}>
                <div className={ isFully ? styles.fullAvatar : styles.avatar }>
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
                <div className={isFully ? styles.fullDescription : styles.description}>
                    <div dangerouslySetInnerHTML={{__html:item.description}}></div>
                </div>
            </div>
            
        </div>
    </>
}

export default TeamItem;