import "../styles/routes/home.scss";
import fire from "../assets/home/hero/fire.png";
import prize from "../assets/home/hero/medal.png";
import notes from "../assets/home/hero/pinned-notes.png"
import cover from "../assets/home/hero/cover.png"
import book from "../assets/home/hero/book.png"
import bookCalendar from "../assets/home/hero/planner.png"

export const HomePage = () => (
        <div className="main-home">
            <div className="hero">
                <div className="add-book">
                    <a className="add-book" href="/store-new-book">
                        <div className="add-book-title">Добавьте новую книгу</div>
                        <div className="add-book-image">
                            <img src={book} alt="Изображение не найдено"/>
                        </div>
                    </a>
                </div>
                <div className="notes">
                    <a className="to-notes" href="#">
                        <div className="notes-title">Ваши заметки</div>
                        <div className="notes-image">
                            <img src={notes} alt="Изображение не найдено"/>
                        </div>
                    </a>
                </div>

                <div className="book-calendar">
                    <a className="book-calendar" href="#">
                        <div className="book-calendar-title">Календарь чтения</div>
                        <div className="book-calendar-image">
                            <img src={bookCalendar} alt="Изображение не найдено"/>
                        </div>
                    </a>
                </div>

                <div className="strike">
                    <div className="strike-info">
                        <div className="image-strike">
                            <img src={prize} alt="Изображение не найдено"/>
                        </div>
                        <div className="text-strike">
                            Лучшая серия: #
                        </div>
                    </div>
                    <div className="strike-info">
                        <div className="image-strike">
                            <img src={fire} alt="Изображение не найдено"/>
                        </div>
                        <div className="text-strike">
                            Текущая серия: #
                        </div>
                    </div>
                    <div className="week">
                        <div className="week-text">
                            На этой неделе:
                        </div>
                        <div className="days">
                            <div className="day">
                                <div className="circle"></div>
                                <div className="day-name">ПН</div>
                            </div>
                            <div className="day">
                                <div className="circle"></div>
                                <div className="day-name">ВТ</div>
                            </div>
                            <div className="day">
                                <div className="circle"></div>
                                <div className="day-name">СР</div>
                            </div>
                            <div className="day">
                                <div className="circle"></div>
                                <div className="day-name">ЧТ</div>
                            </div>
                            <div className="day">
                                <div className="circle"></div>
                                <div className="day-name">ПТ</div>
                            </div>
                            <div className="day">
                                <div className="circle"></div>
                                <div className="day-name">СБ</div>
                            </div>
                            <div className="day">
                                <div className="circle"></div>
                                <div className="day-name">ВС</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div className="lists-books">
                <div className="list">
                    <div className="title-block">Последнее</div>
                    <div className="lists-books-stripe"></div>
                    <div className="books">
                        <a className="book" href="#">
                            <div className="book-image">
                                <img src={cover} alt="Изображение не найдено"/>
                            </div>
                            <div className="book-title">Книга Номер Один Книга Номер Один Книга Номер Один Книга Номер Один</div>
                            <div className="book-last-date">20.05.2025</div>
                        </a>
                        <a className="book" href="#">
                            <div className="book-image">
                                <img src={cover} alt="Изображение не найдено"/>
                            </div>
                            <div className="book-title">Книга Номер Один</div>
                            <div className="book-last-date">20.05.2025</div>
                        </a>
                        <a className="book" href="#">
                            <div className="book-image">
                                <img src={cover} alt="Изображение не найдено"/>
                            </div>
                            <div className="book-title">Книга Номер Один</div>
                            <div className="book-last-date">20.05.2025</div>
                        </a>
                        <a className="book" href="#">
                            <div className="book-image">
                                <img src={cover} alt="Изображение не найдено"/>
                            </div>
                            <div className="book-title">Книга Один</div>
                            <div className="book-last-date">20.05.2025</div>
                        </a>
                        <a className="book" href="#">
                            <div className="book-image">
                                <img src={cover} alt="Изображение не найдено"/>
                            </div>
                            <div className="book-title">Книга Номер Один</div>
                            <div className="book-last-date">20.05.2025</div>
                        </a>
                        <a className="book" href="#">
                            <div className="book-image">
                                <img src={cover} alt="Изображение не найдено"/>
                            </div>
                            <div className="book-title">Книга</div>
                            <div className="book-last-date">20.05.2025</div>
                        </a>
                        <a className="book" href="#">
                            <div className="book-image">
                                <img src={cover} alt="Изображение не найдено"/>
                            </div>
                            <div className="book-title"> Книга Номер Один</div>
                            <div className="book-last-date">20.05.2025</div>
                        </a>
                    </div>
                </div>


                <div className="list">
                    <div className="title-block">В ваших планах</div>
                    <div className="lists-books-stripe"></div>
                    <div className="books">
                        <a className="book" href="#">
                            <div className="book-image">
                                <img src={cover} alt="Изображение не найдено"/>
                            </div>
                            <div className="book-title">Книга Номер Один</div>
                        </a>
                        <a className="book" href="#">
                            <div className="book-image">
                                <img src={cover} alt="Изображение не найдено"/>
                            </div>
                            <div className="book-title">Книга Номер Один Книга Номер Один</div>
                        </a>
                        <a className="book" href="#">
                            <div className="book-image">
                                <img src={cover} alt="Изображение не найдено"/>
                            </div>
                            <div className="book-title">Книга Номер Один</div>
                        </a>
                        <a className="book" href="#">
                            <div className="book-image">
                                <img src={cover} alt="Изображение не найдено"/>
                            </div>
                            <div className="book-title">Книга Один</div>
                        </a>
                        <a className="book" href="#">
                            <div className="book-image">
                                <img src={cover} alt="Изображение не найдено"/>
                            </div>
                            <div className="book-title">Книга Номер Один</div>
                        </a>
                        <a className="book" href="#">
                            <div className="book-image">
                                <img src={cover} alt="Изображение не найдено"/>
                            </div>
                            <div className="book-title">Книга</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    )
;
