import axios from 'axios';
import { getToken, logout } from './auth';

const api = axios.create({
  baseURL: `${process.env.VUE_APP_URL_API}`
});

api.interceptors.request.use(async (config) => {
  const token = getToken();
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

export const AuthService = () => {
  const token = getToken();
  if (token) {
    return api.post(`/show?token='${token}`, {
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
        Authorization: `Bearer ${token}`,
      },
    })
      .catch((err) => {
        console.log(err);
        logout();
      });
  }
};

export default api;
