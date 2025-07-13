import axiosInstance from './axios';

export const fetchReviews = () =>
  axiosInstance.get('/reviews'); 