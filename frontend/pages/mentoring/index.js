import Image from 'next/image'
import styles from '../../styles/public/Mentoring.module.scss'

export default function Mentoring({language}) {

    const lang = language.pages.find(($item) => {return $item.id == 'mentoring'})
    const {title, image, context} = lang

    return <>
        <div className={styles.MentoringContainer}>
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
                                    height={400}
                                    alt=''
                                >
                                </Image>
                            </div>
                            <div className={styles.figcaption}>
                                {image.capture}
                            </div>
                        </div>
                        <p className={styles.textMentoring} dangerouslySetInnerHTML={{__html:context}}>
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