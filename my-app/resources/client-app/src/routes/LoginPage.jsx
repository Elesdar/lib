import React, {useState} from 'react';
import {apiClient, getUser} from "../api/apiClient";
import {useNavigate} from "react-router";
import {useAuth} from "../hooks/useAuth";

export const LoginPage = () => {
    const [loginError, setLoginError] = useState(null);
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const navigate = useNavigate();
    const { login } = useAuth();

    const handleLogin = async (e) => {
        e.preventDefault();

        try {
            const response = await apiClient.post('/api/login', {email, password}, {});
            login(response.data['access_token'], response.data["token_type"])
            console.log('Login successful!', response.data['access_token'], response.data["token_type"]);
            navigate("/");
        } catch (error) {
            if (error.status === 403) {
                window.location = '/';
            }
            console.log(error);
            setLoginError(error.response?.data?.message || 'Login failed!');
        }
    };

    return (
        <>
            <form onSubmit={handleLogin}>
                <label htmlFor="email">Username:</label>
                <input
                    type="email"
                    id="email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                />
                <label htmlFor="password">Password:</label>
                <input
                    type="password"
                    id="password"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                />
                <button type="submit">Login</button>
                {loginError && <p className="error">{loginError}</p>}
            </form>

            <button onClick={getUser}>Get User</button>
        </>
    );
};
