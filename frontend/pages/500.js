import styles from './../styles/public/Error.module.scss'

const err500 = ({language}) => {
    return <>
        <div className={styles.ErrorContainer}>
            <h1 className={styles.errorCode}>
                500
            </h1>
            <div className={styles.verticalLine}> | </div>
            <h2 className={styles.errorMessage}>
                {language.error.e500}
            </h2>
        </div>
    </>
}

export default err500;