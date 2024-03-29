import style from './../../styles/public/Ymaps.module.scss'
import Script from 'next/script'


const YMap = () => {
    return <>
        <div id="yandex_map" className={style.ymap}></div>
        <Script
            id="yandex_map"
            src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A9258bb772418d4001f36561b74613e0d98668d451d86dfe0598ae19c0b628971&amp;width=100%25&amp;id=yandex_map&amp;lang=ru_RU&amp;scroll=true"
            strategy="lazyOnload"
            async={false}
            type="text/javascript"
            onError={(e) => {
                console.error('Script failed to load', e)
            }}
        >
        </Script>
    </>
}

export default YMap;