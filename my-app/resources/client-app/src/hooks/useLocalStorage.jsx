import {useState} from "react";

export const useLocalStorage = (keyName, defaultValue) => {
    const setAccessToken = (accessToken) => {
        try {
            window.localStorage.setItem(keyName, JSON.stringify(accessToken));
        } catch (err) {
            console.log(err);
        }
    };

    const setTokenType = (tokenType) => {
        try {
            window.localStorage.setItem(keyName, JSON.stringify(tokenType));
        } catch (err) {
            console.log(err);
        }
    }

    return [setAccessToken, setTokenType];
}
