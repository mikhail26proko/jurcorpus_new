import Image from 'next/image'
import styles from '../../styles/public/Mentoring.module.scss'

export default function Mentoring({language}) {

    return <>
        <div className={styles.MentoringContainer}>
            <div className={styles.Board}>
                <div className={styles.white}>
                    <div className={styles.content}>
                        <h2>
                            {language.mentoring.mentoring}
                        </h2>
                        <div className={styles.rightImage}>
                            <div className={styles.picture}>
                                <Image
                                    src='/images/mentoring.jpg'
                                    width={300}
                                    height={400}
                                    alt=''
                                >
                                </Image>
                            </div>
                            <div className={styles.figcaption}>
                                {language.mentoring.figcaption}
                            </div>
                        </div>
                        <p className={styles.textMentoring} dangerouslySetInnerHTML={{__html:language.mentoring.context}}>
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