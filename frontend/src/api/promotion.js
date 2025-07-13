import axiosInstance from './axios';

export const fetchPromotions = () =>
  axiosInstance.get('/promotion'); 