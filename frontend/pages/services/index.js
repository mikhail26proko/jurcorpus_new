import Image from 'next/image'
import styles from '../../styles/public/Services.module.scss'

export default function Services({language}) {

    return <>
        <div className={styles.ServicesContainer}>
            <div className={styles.Board}>
                <div className={styles.white}>
                    <div className={styles.content}>
                        <h2>
                            {language.services.services}
                        </h2>
                        <div className={styles.rightImage}>
                            <div className={styles.picture}>
                                <Image
                                    src='/images/lawyers/lawyer.jpg'
                                    width={300}
                                    height={300}
                                    alt=''
                                >
                                </Image>
                            </div>
                            <div className={styles.figcaption}>
                                {language.services.figcaption}
                            </div>
                        </div>
                        <p className={styles.textServices} dangerouslySetInnerHTML={{__html:language.services.context}}>
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </>
}

export async function getStaticProps(context) {
    return {
        props: {
            context,
        },
    };
}