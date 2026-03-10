import { useNavigate, Outlet } from "react-router";
import {isAuthorized} from "../api/apiClient";
import {useEffect} from "react";

export const AuthLayout = () => {
    const navigate = useNavigate();

    useEffect(() => {
        const  userAuthStatus  = async () => {
            const result = await isAuthorized()

            if (result == true) {
                navigate("/");
            }
        };
        userAuthStatus();
    })

    return (
        <div className="wrapper">
            <Outlet />
        </div>
    )
};
