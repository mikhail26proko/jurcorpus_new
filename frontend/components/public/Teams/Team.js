import Accordion from '@mui/material/Accordion';
import AccordionSummary from '@mui/material/AccordionSummary';
import AccordionDetails from '@mui/material/AccordionDetails';
import ExpandMoreIcon from '@mui/icons-material/ExpandMore';

import TeamItem from "./TeamItem"

import styles from '../../../styles/public/Team.module.scss'

const Team = ( { item, isExpanded, handle } ) => {


    return <>
        <Accordion
            TransitionProps={{ unmountOnExit: true }}
            expanded={isExpanded}
            onChange={handle}
        >
            <AccordionSummary
                expandIcon={<ExpandMoreIcon />}
                aria-controls="panel1a-content"
                id="panel1a-header"
            >
                <h3> {item.department} </h3>
                
            </AccordionSummary>
            <AccordionDetails
                className={styles.details}
            >
                <div className={styles.adress}>
                    <h4> Адрес : {item.adress} </h4>
                </div>
                <br/>
                {item.team.map((worker,index)=>(
                    <TeamItem
                        key={index}
                        item={worker}
                    ></TeamItem>
                ))}
            </AccordionDetails>
        </Accordion>
    </>
}

export default Team;