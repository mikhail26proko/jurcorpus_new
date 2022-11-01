import AdminMenuItem from './MenuItem'
import Logo from "../../Logo"
import style from './../../../styles/public/Layout.module.scss'

const AdminMenu = () => {

    const menuItems = Array.from({
        0: {
            k:"/",
            v:"Главная",
            l: "Основная страница(в разработке)",
        },
        1: {
            k:"/leads",
            v:"Заявки",
            l: "Заявки поступившие с сайта\nЗадел на CRM",
        },
        2: {
            k:"/blog",
            v:"Блог",
            l:"Вкладка для работы с постами",
        },
        3: {
            k:"/profiles",
            v:"Пользователи",
            l:"Добавление, Редактирование, Удаление Пользователей.\nОтображение на вкладке Команда(публичность)",
        },
        4: {
            k:"/lang",
            v:"Языки",
            l:"Редактирование языковых файлов для внешней части сайта"
        },
        5: {
            k:"/settings",
            v:"Настройки",
            l:"Настройка сайта(планируется)",
        },
        length: 6,
    });

    return <>
        <div className = { style.menuContainer }>
            <div className = { style.logo }>
                <Logo/>
            </div>
            { menuItems?.map( ( menuItem, index ) => (
                <AdminMenuItem
                    key={index}
                    menuItem = { menuItem }
                />
            ))}
        </div>

    </>
}

export default AdminMenu;
