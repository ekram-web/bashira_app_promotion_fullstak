import axiosInstance from './axios';

export const sendContactMessage = (data) =>
  axiosInstance.post('/contact-message', data); 