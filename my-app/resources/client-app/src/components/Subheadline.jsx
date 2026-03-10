import React from "react";

import "../styles/components/subheadline.scss";

export const Subheadline = (props) => {
    return (
        <div className="subheadline">{props.title}</div>
    )
}
