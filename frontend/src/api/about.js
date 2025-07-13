import axiosInstance from './axios';

export const fetchAbout = () =>
  axiosInstance.get('/about'); 