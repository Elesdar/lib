import React from "react";
import "../styles/components/search-block.scss";

export const SearchBlock = () => {
    return (
        <div className="search-block">
            <div className="field">
                <input name="search_text" placeholder="Поиск по названию..."/>
            </div>
        </div>
    )
}
