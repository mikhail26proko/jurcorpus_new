import * as React from 'react';
import Accordion from '@mui/material/Accordion';
import AccordionSummary from '@mui/material/AccordionSummary';
import AccordionDetails from '@mui/material/AccordionDetails';
import ExpandMoreIcon from '@mui/icons-material/ExpandMore';

import TeamItem from "./TeamItem"

import styles from '../../../styles/public/Team.module.scss'

const Department = ( { item } ) => {

    const [expanded, setExpanded] = React.useState('panel01');

    const handleChange = (panel) => (event, isExpanded) => {
        setExpanded(isExpanded ? panel : false);
    };

    return <>
        <Accordion
            key={("Accordion" + item.id)}
            expanded={expanded === ("panel"+item.id)}
            onChange={handleChange(("panel"+item.id))}
        >
            <AccordionSummary
                expandIcon={<ExpandMoreIcon />}
                aria-controls="panel1a-content"
                id="panel1a-header"
            >
                <h3>{item.department}</h3>
            </AccordionSummary>
            <AccordionDetails
                className={styles.details}
            >
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

export default Department;