import { YMaps, Map, Placemark } from "react-yandex-maps";

const YMap = () => {

    const JurCorpusCords = [44.938885, 34.092143]
    const mapState = {
        center: JurCorpusCords,
        zoom:18,
    };

    return <>
        <YMaps>
            <Map
                defaultState={mapState}
                width="100%"
                height="100%"
                query={{ lang: 'ru_RU' }}
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