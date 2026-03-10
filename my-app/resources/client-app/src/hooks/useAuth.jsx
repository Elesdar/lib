import {createContext, useContext, useMemo} from "react";
import {useNavigate} from "react-router";
import {useLocalStorage} from "./useLocalStorage";

const AuthContext = createContext();

export const AuthProvider = ({children}) => {
    const [accessToken, setAccessToken] = useLocalStorage("access_token", null);
    const [tokenType, setTokenType] = useLocalStorage("token_type", null)
    const navigate = useNavigate();

    // call this function when you want to authenticate the user
    const login = async (accessToken, tokenType) => {
        setAccessToken(accessToken);
        setTokenType(tokenType);
        navigate("/home");
    };

    // call this function to sign out logged in user
    const logout = () => {
        setAccessToken(null);
        setTokenType(null);
        navigate("/", {replace: true});
    };

    const value= {
        accessToken,
        tokenType,
        login,
        logout,
    };

    return <AuthContext.Provider value={value}>{children}</AuthContext.Provider>;
};

export const useAuth = () => {
    return useContext(AuthContext);
};

