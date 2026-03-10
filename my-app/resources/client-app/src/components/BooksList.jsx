import React from "react";
import "../styles/components/books-list.scss"


export const BooksList = (props) => {
    return (
        <table className="table-list-lines">
            <thead>
            <tr>
                <th className="index">#</th>
                <th className="name order-control" data-order="name"
                    title="Упорядочить по названию">Название
                </th>
                <th className="num order-control active" data-order="rate_score"
                    title="Упорядочить по оценке">Оценка
                </th>
                <th className="num order-control" data-order="episodes"
                    title="Упорядочить по количеству страниц">Страницы
                </th>
                <th className="num order-control" data-order="kind" title="Упорядочить по типу">Тип</th>
            </tr>
            <tr className="border">
                <th colSpan="5"></th>
            </tr>
            </thead>
            <tbody className="entries">

            {props.books.map((book, i) =>
                <tr className="user-rate" data-target-id={book.id}
                    data-target-name={book.title} key={book.id}>
                    <td className="index"><span>{i + 1}</span></td>
                    <td className="name">
                        <a className="link" href="/books/28249">
                            <span className="name">{book.title}</span>
                        </a>
                    </td>
                    <td className="num hoverable">
                        <span className="current-value" data-field="score" data-max="10" data-min="0">
                            {book.rating ?? "-"}
                        </span>
                    </td>
                    <td className="num hoverable">
                        <span className="current-value" data-field="episodes" data-max="#" data-min="0">
                            <span>{book.count_finished_pages ?? 0}</span>
                        </span>
                        <span className="misc-value">
                            <span className="b-separator inline">/</span>
                            {book.count_pages ?? 0}
                        </span>
                    </td>
                    <td className="num">{book.type.label}</td>
                </tr>
            )}
            </tbody>
        </table>
    )
}
