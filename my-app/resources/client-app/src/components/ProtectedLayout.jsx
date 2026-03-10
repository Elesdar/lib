import {useNavigate, Outlet} from "react-router";
import {useEffect, useState} from "react";
import {isAuthorized} from "../api/apiClient.jsx";
import {HeaderLayout} from "./HeaderLayout.jsx";
import {FooterLayout} from "./FooterLayout.jsx";

export const ProtectedLayout = () => {
    const navigate = useNavigate();
    const [authorized, setAuthorized] = useState(false);

    useEffect(() => {
        const userAuthStatus = async () => {
            const result = await isAuthorized()
            setAuthorized(result);
            if (result == false) {
                navigate("/login");
            }
        };
        userAuthStatus();

    }, [navigate])

    return authorized ?
        <div className="wrapper">
            <HeaderLayout/>
            <Outlet/>
            <FooterLayout/>
        </div>
        : null;
};
