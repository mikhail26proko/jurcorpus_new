import Image from 'next/image'

import styles from '../../styles/public/About.module.scss'

export default function About({language}) {

    return <>
        <div className={styles.AboutContainer}>
            <div className={styles.Board}>
                <div className={styles.white}>
                    <div className={styles.content}>
                        <h2>
                            {language.about.about}
                        </h2>
                        <div className={styles.rightImage}>
                            <Image
                                src='/images/HalaimovG.jpg'
                                width={300}
                                height={200}
                                alt=''
                            >
                            </Image>
                        </div>
                        <p className={styles.textAbout} dangerouslySetInnerHTML={{__html:language.about.context}}>
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </>
}