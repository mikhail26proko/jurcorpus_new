import styles from './../../styles/public/Contact.module.scss'
import YMap from './../../components/public/YMap.js'

export default function Contacts({language}) {
  return <>
    <div className={styles.stampContainer}>
      <div className={styles.stamp}>
        <div className={styles.white}>
          <h4>{language.contact.contact}</h4>
            <h5>{language.contact.adress}</h5>
            <p className={styles.Context}>
              {language.contact.adressInfo}
            </p>
            <h5>{language.contact.phoneAndMail}</h5>
            <p className={styles.Context}>
              {language.contact.phoneInfo}
              <br/>
              {language.contact.MailInfo}
            </p>
          <br />
            <p className={styles.Notes}>
              {language.contact.notes}
            </p>
        </div>
      </div>
    </div>
    <div className={styles.mapContainer}>
      <div className={styles.map}>
          <YMap/>
      </div>
    </div>
  </>
}