import "../styles/routes/books-page.scss";
import React, {useEffect, useState} from "react";
import {useNavigate, useParams} from "react-router";
import {apiClient, getBooks} from "../api/apiClient.jsx";
import {BooksList} from "../components/BooksList.jsx";
import {SearchBlock} from "../components/SearchBlock.jsx";
import {Subheadline} from "../components/Subheadline.jsx";

export const BooksPage = () => {
    const [books, setBooks] = useState([]);
    const navigate = useNavigate();

    useEffect(() => {
        const getUserBooks = async () => {
            try {
                const result = await getBooks();
                setBooks(result.data);
                console.log(result.data);
            } catch (e) {
                console.log(e);
            }
        }
        getUserBooks();
    }, [])

    return (
        <div className="main-books">
            <div className="books-lists">
                <div className="lists-links">
                    <a className="link always-active" data-id="planned" href="/Nielw/list/anime?order=kind">
                        Запланировано <span>430</span>&nbsp;
                    </a>
                    <a className="link always-active selected" data-id="reading"
                       href="/Nielw/list/anime?mylist=watching&amp;order=kind">
                        &nbsp;Читаю <span>4</span>&nbsp;
                    </a>
                    <a className="link always-active" data-id="rereading"
                       href="/Nielw/list/anime?mylist=rewatching&amp;order=kind">
                        &nbsp;Перечитываю<span>0</span>&nbsp;
                    </a>
                    <a className="link always-active" data-id="completed"
                       href="/Nielw/list/anime?mylist=completed&amp;order=kind">
                        &nbsp;Прочитано <span>220</span>&nbsp;
                    </a>
                    <a className="link always-active" data-id="on-hold"
                       href="/Nielw/list/anime?mylist=on_hold&amp;order=kind">
                        &nbsp;Отложено <span>17</span>&nbsp;
                    </a>
                    <a className="last-link always-active" data-id="dropped"
                       href="/Nielw/list/anime?mylist=dropped&amp;order=kind">
                        &nbsp;Брошено <span>19</span>
                    </a>
                </div>
                <Subheadline title={"Список книг" ?? ""} />
                <SearchBlock></SearchBlock>
                <div className="list-groups">
                    <header className="status-1">
                        <Subheadline title={"Читаю" ?? ""} />
                    </header>
                    <BooksList books={books ?? []} />
                </div>

            </div>
        </div>
    )
}
