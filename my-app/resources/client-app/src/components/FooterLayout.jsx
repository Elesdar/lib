import "../styles/components/footer.scss";
import vkIcon from "../assets/social_icons/vk.png"
import telegramIcon from "../assets/social_icons/telegram.png"
import youtubeIcon from "../assets/social_icons/youtube.png"

export const FooterLayout = () => (
    <div className="footer">
        <div className="navigation">
            <div className="footer-navigation-title">Навигация:</div>
            <a className="footer-navigation-link" href="#">Книги</a>
            <a className="footer-navigation-link" href="#">Коллекции</a>
            <a className="footer-navigation-link" href="#">Библиотеки</a>
            <a className="footer-navigation-link" href="#">Статистика</a>
            <a className="footer-navigation-link" href="#">Настройки</a>
        </div>
        <div className="info">
            <div className="footer-info-title">Информация:</div>
            <a className="footer-info-link" href="#">Пользовательское соглашение</a>
            <a className="footer-info-link" href="#">Политика конфиденциальности</a>
        </div>
        <div className="contacts">
            <div className="footer-contacts-title">Наши контакты:</div>
            <div className="footer-phone-number">8 800 666-8-444</div>
            <div className="footer-email">support@homelibrary.com</div>
        </div>
        <div className="social-links">
            <a className="footer-social-link" href="#"> <img src={vkIcon} alt="Изображение не найдено"/></a>
            <a className="footer-social-link" href="#"> <img src={telegramIcon} alt="Изображение не найдено"/></a>
            <a className="footer-social-link" href="#"> <img src={youtubeIcon} alt="Изображение не найдено"/></a>
        </div>
    </div>
);
