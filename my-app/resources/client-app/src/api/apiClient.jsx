import axios from 'axios';

export const apiClient = axios.create({
    baseURL: 'http://localhost',
    withCredentials: true,
    withXSRFToken: true,
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
});

export const updateAuthorizationHeader = () => {
    apiClient.defaults.headers.common['Authorization'] = `bearer ${JSON.parse(window.localStorage.getItem('access_token'))}`;
}

export const getUser = async () => {
    try {
        const response = await apiClient.get('/api/user', {})
        console.log('User data:', response.data);
        return response.data;
    } catch (error) {
        console.error('Error fetching user data:', error);
        return null;
    }
};

export const isAuthorized = async () => {
    try {
        await updateAuthorizationHeader();  // TODO перекинуть в логин?
        const response = await apiClient.get('/api/user/check', {})
        return response.data['isAuthorized'];
    } catch (error) {
        console.error(error);
        return false;
    }
};

export const handleLogout = async () => {
    try {
        const response = await apiClient.post('/api/logout', {}, {});
        window.localStorage.setItem('token_type', null);
        window.localStorage.setItem('access_token', null)
        console.log('Logout successful!', response.data);
    } catch (error) {
        console.error('Logout failed:', error);
    }
};

export const getCollections = async () => {
    const response = await apiClient.get('/api/collections/', {});
    return response.data;
}

export const getCollection = async (id) => {
    const response = await apiClient.get('/api/collections/' + id, {});
    return response.data;
}

export const getBooks = async () => {
    const response = await apiClient.get('/api/books/', {});
    return response.data;
}

export const getLibrary = async (id) => {
    const response = await apiClient.get('/api/libraries/' + id, {});
    return response.data;
}
