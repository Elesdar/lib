import React, {useEffect, useState} from "react";
import "../styles/routes/collections-page.scss";
import collectionDefaultImg from "../assets/default/collection.jpg";
import addCollection from "../assets/folder.png";
import {getCollections} from "../api/apiClient.jsx";
import {useNavigate} from "react-router";


export const CollectionsPage = () => {
    const [collections, setCollections] = useState([]);

    useEffect(() => {
        const collectionsArray = async () => {
            try {
                const result = await getCollections();
                setCollections(result.data);
                console.log(result.data);
            } catch (e) {
                console.log(e);
            }
        }
        collectionsArray();

    }, [])
    const navigate = useNavigate();

    return (
        <div className="main-collections">
            <div className="collections">
                <div className="add-collection">
                    <a className="add-collection" href="/store-new-collection">
                        <div className="add-collection-image">
                            <img className="img-add-collection" src={addCollection} alt="Изображение не найдено"/>
                        </div>
                        <div className="add-collection-title">Добавьте новую коллекцию</div>
                    </a>
                </div>
                {collections.map((collection) =>
                        <div className="collection" key={collection.id}>
                            <a className="collection" href={"/collections/" + collection.id}>
                                <div className="collection-image">
                                    <img className="img-collection" src={collection.cover ? collection.cover : collectionDefaultImg} alt="Изображение не найдено"/>
                                </div>
                                <div className="collection-title">{collection.title}</div>
                            </a>
                        </div>
                )}
            </div>
        </div>
    )
}
