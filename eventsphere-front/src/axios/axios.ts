import axios from 'axios';

const api_url = import.meta.env.VITE_BACKEND_URL
const token_name = import.meta.env.VITE_AUTH_TOKEN_NAME

export const instance = axios.create({
  baseURL: api_url,
  headers: {
    'Content-Type': 'application/json'
  },
});

axios.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem(token_name);
    if (token) {
      config.headers.Authorization = token;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

