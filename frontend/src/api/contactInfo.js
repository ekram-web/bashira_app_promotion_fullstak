import axiosInstance from './axios';

export const fetchContactInfo = () =>
  axiosInstance.get('/contact-info'); 