import styles from '../../styles/public/About.module.scss'

export default function About({language}) {

    return <>
        <div className={styles.AboutContainer}>
            <div className={styles.Board}>
                <div className={styles.white}>
                    <h2>
                        {language.about.about}
                    </h2>
                    <br/>
                    <p>
                        {language.about.context}
                    </p>
                </div>
            </div>
        </div>
    </>
}