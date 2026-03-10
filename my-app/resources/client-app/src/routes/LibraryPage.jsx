import React, {useEffect, useState} from "react";
import {useNavigate, useParams} from "react-router";
import {getLibrary} from "../api/apiClient.jsx";
import {Subheadline} from "../components/Subheadline.jsx";
import {SearchBlock} from "../components/SearchBlock.jsx";
import "../styles/components/books-list.scss";
import "../styles/routes/library-page.scss";
import "../styles/components/button-add-resource.scss"

export const LibraryPage = () => {
    const navigate = useNavigate();
    const [library, setLibrary] = useState([]);
    const {id} = useParams();

    useEffect(() => {
        const libraryData = async () => {
            try {
                const result = await getLibrary(id);
                setLibrary(result.data);
                console.log(result.data);
            } catch (e) {
                console.log(e);
            }
        }
        libraryData();

    }, [])

    return (
        <div className="main-books">
            <div className="books-lists">
                <Subheadline title={"Ваша библиотека" ?? ""}/>
                <br></br>
                <SearchBlock></SearchBlock>
                <div className="list-groups">
                    <header className="header-list-books">
                        <Subheadline className="gg" title={"Список книг" ?? ""}/>
                        <a href="#" className="button-add-resource"><span className="mb-text" >Добавить книгу</span></a>
                    </header>
                    <table className="table-list-lines">
                        <thead>
                        <tr>
                            <th className="index">#</th>
                            <th className="name order-control" data-order="name"
                                title="Упорядочить по названию">Название
                            </th>
                            <th className="num order-control active" data-order="rate_score"
                                title="Упорядочить по году"> Год
                            </th>
                            <th className="num order-control active" data-order="rate_score"
                                title="Упорядочить по обложке"> Обложка
                            </th>
                            <th className="num order-control active" data-order="rate_score"
                                title="Упорядочить по формату"> Формат
                            </th>
                            <th className="num order-control" data-order="episodes"
                                title="Упорядочить по количеству страниц">Страницы
                            </th>
                            <th className="num order-control" data-order="kind" title="Упорядочить по типу">Тип</th>
                            <th className="num order-control active" data-order="rate_score"
                                title="Упорядочить по isbn"> ISBN
                            </th>
                        </tr>
                        <tr className="border">
                            <th colSpan="5"></th>
                        </tr>
                        </thead>
                        <tbody className="entries">

                        {library.books?.map((book, i) =>
                            <tr className="user-rate" data-target-id={i}
                                data-target-name={book.title} key={i}>
                                <td className="index"><span>{i + 1}</span></td>
                                <td className="name">
                                    <a className="book-link" href="#">
                                        <span className="name">{book.title}</span>
                                    </a>
                                </td>
                                <td className="num hoverable">
                                    <span className="misc-value">
                                        {book.count_pages ?? 0}
                                    </span>
                                </td>
                                <td className="num">{book.type.label}</td>
                                <td className="num hoverable">
                                        <span className="current-value" data-field="" >
                                            978-5-699-12014-7
                                        </span>
                                </td>
                            </tr>
                        )}
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    );
};
