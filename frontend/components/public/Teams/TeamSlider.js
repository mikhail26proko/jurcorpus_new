import TeamItem from './TeamItem.js'

import styles from '../../../styles/public/Team.module.scss'

const TeamSlider = ( { team } ) => {
    return <>
        <div className={styles.TeamSlider}>
            {team?.map((item, index)=>(
                <TeamItem
                    key={index}
                    item={item}
                />
            ))}
        </div>
    </>
}

export default TeamSlider;