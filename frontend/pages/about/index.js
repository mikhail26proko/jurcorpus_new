import Image from 'next/image'
import styles from '../../styles/public/About.module.scss'

export default function About({language, props}) {

    const lang = language.pages.find(($item) => {return $item.id == 'about'})
    const {title, image, context} = lang

    return <>
        <div className={styles.AboutContainer}>
            <div className={styles.Board}>
                <div className={styles.white}>
                    <div className={styles.content}>
                        <h2>
                            {title}
                        </h2>
                        <div className={styles.rightImage}>
                            <div className={styles.picture}>
                                <Image
                                    src={image.src}
                                    width={300}
                                    height={200}
                                    alt=''
                                >
                                </Image>
                            </div>
                            <div className={styles.figcaption}>
                                {image.capture}
                            </div>
                        </div>
                        <p className={styles.textAbout} dangerouslySetInnerHTML={{__html:context}}>
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