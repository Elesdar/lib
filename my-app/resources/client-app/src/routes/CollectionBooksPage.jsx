import "../styles/routes/collections-books-page.scss";
import React, {useEffect, useState} from "react";
import {getCollection} from "../api/apiClient.jsx";
import {useNavigate, useParams} from "react-router";
import {BooksList} from "../components/BooksList.jsx";
import {SearchBlock} from "../components/SearchBlock.jsx";
import {Subheadline} from "../components/Subheadline.jsx";

export const CollectionBooksPage = () => {
    const [collection, setCollection] = useState([]);
    const {id} = useParams();
    const navigate = useNavigate();

    useEffect(() => {
        const getCol = async () => {
            try {
                const result = await getCollection(id);
                setCollection(result.data);
                console.log(result.data);
            } catch (e) {
                console.log(e);
            }
        }
        getCol();

    }, [])

    return (
        <div className="main-books">
            <div className="books-lists">
                <Subheadline title={collection.title ?? ""} />
                <div className="description">{collection.description}</div>
                <br></br>
                <SearchBlock></SearchBlock>
                <div className="list-groups">
                    <header className="status">
                        <Subheadline title={"Список книг" ?? ""} />
                    </header>
                    <BooksList books={collection.books ?? []} />
                </div>

            </div>
        </div>
    )
}
