import Image from 'next/image'
import styles from '../../styles/public/About.module.scss'

export default function About({language, props}) {

    return <>
        <div className={styles.AboutContainer}>
            <div className={styles.Board}>
                <div className={styles.white}>
                    <div className={styles.content}>
                        <h2>
                            {language.about.about}
                        </h2>
                        <div className={styles.rightImage}>
                            <div className={styles.picture}>
                                <Image
                                    src='/images/HalaimovG.jpg'
                                    width={300}
                                    height={200}
                                    alt=''
                                >
                                </Image>
                            </div>
                            <div className={styles.figcaption}>
                                {language.about.figcaption}
                            </div>
                        </div>
                        <p className={styles.textAbout} dangerouslySetInnerHTML={{__html:language.about.context}}>
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