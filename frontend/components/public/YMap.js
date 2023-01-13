// import styles from './../../../styles/public/About.module.scss'
import { YMaps, Map, Placemark } from '@pbe/react-yandex-maps';

const YMap = () => {

    const JurCorpusCords = [44.938885, 34.092143]
    const mapState = {
        center: JurCorpusCords,
        zoom: 18,
        controls: ["zoomControl", "fullscreenControl"],
    };

    return <>
        <YMaps
            query={{
                apikey:'d10f2783-3990-4d1a-9532-f26300d61372',
                lang: 'ru_RU',
                ns: "use-load-option",
                load: "Map,Placemark,control.ZoomControl,control.FullscreenControl",
            }}
        >
            <Map
                defaultState={mapState}
            >
                <Placemark
                    geometry={JurCorpusCords}
                    options={{
                        preset:'islands#circleIcon',
                        iconColor:'red'
                    }}
                />
            </Map>
        </YMaps>
    </>
}

export default YMap;