import styles from '../../styles/public/Team.module.scss'

export default function Team({language}) {

    return <>
        <div className={styles.TeamContainer}>
            {language.team.team}
        </div>
    </>
}