import Image from 'next/image'
import styles from '../../styles/public/Services.module.scss'

export default function Services({language}) {

    const lang = language.pages.find(($item) => {return $item.id == 'services'})
    const {title, image, context} = lang

    return <>
        <div className={styles.ServicesContainer}>
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
                                    height={300}
                                    alt=''
                                >
                                </Image>
                            </div>
                            <div className={styles.figcaption}>
                                {image.capture}
                            </div>
                        </div>
                        <p className={styles.textServices} dangerouslySetInnerHTML={{__html:context}}>
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