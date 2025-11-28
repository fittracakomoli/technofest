import axios from 'axios';

const baseURL = import.meta.env.VITE_API_URL || 'http://localhost:8000';
const STORAGE_KEY = 'tf_token';

const api = axios.create({
  baseURL,
  withCredentials: import.meta.env.VITE_USE_CREDENTIALS === 'true',
  headers: { Accept: 'application/json' },
});

export default api;