import styles from './../styles/public/Error.module.scss'

const err404 = ({language}) => {
    return <>
        <div className={styles.ErrorContainer}>
            <h1 className={styles.errorCode}>
                404
            </h1>
            <div className={styles.verticalLine}> | </div>
            <h2 className={styles.errorMessage}>
                {language.error.e404}
            </h2>
        </div>
    </>
}

export default err404;