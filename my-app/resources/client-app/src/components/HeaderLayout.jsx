import "../styles/components/header.scss";
import logo from "../assets/logo.png";
import library from "../assets/menu_icons/library.png"
import list from "../assets/menu_icons/bookmark.png"
import collection from "../assets/menu_icons/bookshelf.png"
import stats from "../assets/menu_icons/report.png"
import user from "../assets/menu_icons/people.png"

export const HeaderLayout = () => {
    return (
        <div className="header">
            <div className="logo">
                <a href="/home">
                    <img src={logo} alt="Изображение не найдено"/>
                </a>
            </div>
            <div className="menu">
                <a className="icon-link" href="/books">
                    <span
                        className="icon">
                        <img src={list} alt="Изображение не найдено"/>
                   </span>
                    <span className="icon-button-text">Книги</span>
                </a>
                <a className="icon-link" href="/collections">
                    <span
                        className="icon">
                        <img src={collection} alt="Изображение не найдено"/>
                   </span>
                    <span className="icon-button-text">Коллекции</span>
                </a>

                <a className="icon-link" href="/library">
                    <span
                        className="icon">
                        <img src={library} alt="Изображение не найдено"/>
                   </span>
                    <span className="icon-button-text">Библиотека</span>
                </a>
                <a className="icon-link" href="#">
                    <span
                        className="icon">
                        <img src={stats} alt="Изображение не найдено"/>
                   </span>
                    <span className="icon-button-text">Статистика</span>
                </a>
                <a className="icon-link" href="#">
                    <span
                        className="icon">
                        <img src={user} alt="Изображение не найдено"/>
                   </span>
                    <span className="icon-button-text">Настройки</span>
                </a>
            </div>
        </div>
    )

};
