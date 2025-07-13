import axiosInstance from './axios';

export const fetchOffers = () =>
  axiosInstance.get('/offers'); 