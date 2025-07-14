import axios from './axios';

export const fetchYoutubeVideos = () => {
  return axios.get('/youtube/latest');
}; 