import React, {useState} from 'react';
import {apiClient} from "../api/apiClient";

export const RegistrationPage = () => {

    const [registerError, setRegisterError] = useState(null);
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [password_confirmation, setPasswordConfirmation] = useState('');

    const handleRegistrationForm = async (e) => {
        e.preventDefault();

        try {
            const response = await apiClient.post('/api/register',
                {name, email, password, password_confirmation},
                {});
            console.log('Success!', response.data);
        } catch (error) {
            if (error.status === 403) {
                window.location = '/';
            }
            setRegisterError(error.response?.data?.message || 'Fail!');
        }
    };

    return (
        <>
            <form onSubmit={handleRegistrationForm}>
                <label htmlFor="name">Name: </label>
                <input
                    type="name"
                    id="name"
                    value={name}
                    onChange={(e) => setName(e.target.value)}
                />
                <br/>
                <label htmlFor="email">Email: </label>
                <input
                    type="email"
                    id="email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                />
                <br/>
                <label htmlFor="password">Password: </label>
                <input
                    type="password"
                    id="password"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                />
                <br/>
                <label htmlFor="password_confirmation">Password Confirmation: </label>
                <input
                    type="password"
                    id="password_confirmation"
                    value={password_confirmation}
                    onChange={(e) => setPasswordConfirmation(e.target.value)}
                />
                <br/>

                <button type="submit">Register</button>
                {registerError && <p className="error">{registerError}</p>}
            </form>
        </>
    );
};
