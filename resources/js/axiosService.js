import axios from 'axios';
import router from './router'; // import your router to handle redirection
import { jwtDecode } from "jwt-decode";
// Create an instance of Axios without a baseURL
const axiosInstance = axios.create();

const isTokenExpired = () => {
    const token = localStorage.getItem('access_token');
    if (token) {
        const decodedToken = jwtDecode(token);
        const currentTime = Date.now() / 1000;
        return decodedToken.exp < currentTime;
    }
    return true; // If no token exists, treat it as expired
};

// Add a request interceptor to include the access token
axiosInstance.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem('access_token');

        if (isTokenExpired()) {
            // If the token is expired, remove it and redirect to login
            localStorage.removeItem('access_token');
            localStorage.removeItem('expires_in');
            router.push('/');
            return Promise.reject(new Error('Token expired. Redirecting to login.'));
        }

        if (token) {
            config.headers['Authorization'] = `Bearer ${token}`;
        }
        return config;
    },
    (error) => {
        // Handle the error
        return Promise.reject(error);
    }
);

export default axiosInstance;