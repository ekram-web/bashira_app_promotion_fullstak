import axiosInstance from './axios';

export const fetchHero = () =>
  axiosInstance.get('/hero'); 