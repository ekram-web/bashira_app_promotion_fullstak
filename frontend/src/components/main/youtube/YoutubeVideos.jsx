import React, { useEffect, useState } from "react";
import { FaPlay } from "react-icons/fa";
import styles from "./Youtube.module.css";

function chunkArray(array, size) {
  const result = [];
  for (let i = 0; i < array.length; i += size) {
    result.push(array.slice(i, i + size));
  }
  return result;
}

// Helper to detect if a video is a YouTube Short
function isShortVideo(video) {
  if (!video || !video.snippet) return false;
  // Check for #shorts in title (case-insensitive)
  return video.snippet.title.toLowerCase().includes("#shorts");
}

function YoutubeVideos() {
  const [videos, setVideos] = useState([]);
  const [sortOption, setSortOption] = useState("date");
  const [loading, setLoading] = useState(false);
  const [selectedVideo, setSelectedVideo] = useState(null);

  useEffect(() => {
    setLoading(true);
    const API_KEY = import.meta.env.VITE_YOUTUBE_API_KEY;
    const CHANNEL_ID = import.meta.env.VITE_YOUTUBE_CHANNEL_ID;
    fetch(
      `https://youtube.googleapis.com/youtube/v3/search?part=snippet&channelId=${CHANNEL_ID}&maxResults=9&order=${sortOption}&key=${API_KEY}`
    )
      .then((res) => res.json())
      .then((data) => {
        setVideos(data.items || []);
        setLoading(false);
      })
      .catch(() => {
        setLoading(false);
      });
  }, [sortOption]);

  const handleVideoClick = (video) => {
    setSelectedVideo(video);
  };

  const handleCloseVideo = () => {
    setSelectedVideo(null);
  };

  const handleSortChange = (e) => {
    setSortOption(e.target.value);
  };

  // Group videos into rows of 3
  // const videoRows = chunkArray(videos, 3);

  // Limit to 6 videos and chunk into 2 rows of 3
  const limitedVideos = videos.slice(0, 6);
  const videoRows = chunkArray(limitedVideos, 3);

  return (
    <section className={styles.youtubeSection}>
      <div className={styles.youtubeContainer}>
        {/* Header */}
        <div className={styles.youtubeHeader}>
          <h2 className={styles.youtubeTitle}>Latest Videos</h2>
          <p className={styles.youtubeSubtitle}>
            Discover our latest content and stay updated with our newest videos
          </p>
        </div>

        {/* Filter */}
        <div className={styles.filterContainer}>
          <select
            className={styles.filterSelect}
            value={sortOption}
            onChange={handleSortChange}
          >
            <option value="date">Latest Videos</option>
            <option value="rating">Most Popular</option>
            <option value="relevant">Most Relevant</option>
            <option value="viewCount">Most Viewed</option>
          </select>
        </div>

        {/* Loading State */}
        {loading && (
          <div className={styles.loadingContainer}>
            <div className={styles.spinner}></div>
            <p>Loading videos...</p>
          </div>
        )}

        {/* Video Grid in Rows */}
        {!loading && videos.length > 0 && (
          <div>
            {videoRows.map((row, rowIndex) => {
              // Check if selectedVideo is in this row
              const isSelectedInRow =
                selectedVideo &&
                row.some((v) => v.id.videoId === selectedVideo.id.videoId);
              return (
                <React.Fragment key={rowIndex}>
                  <div className={styles.videoGrid}>
                    {row.map((video) => (
                      <div
                        key={video.id.videoId}
                        className={`${styles.videoCard} ${
                          selectedVideo &&
                          selectedVideo.id.videoId === video.id.videoId
                            ? styles.selected
                            : ""
                        }`}
                        onClick={() => handleVideoClick(video)}
                      >
                        <div className={styles.videoThumbnail}>
                          <img
                            src={video.snippet.thumbnails.high.url}
                            alt={video.snippet.title}
                          />
                          <div className={styles.playButton}>
                            <FaPlay className={styles.playIcon} />
                          </div>
                        </div>
                        <div className={styles.videoInfo}>
                          <h3 className={styles.videoTitle}>
                            {video.snippet.title}
                          </h3>
                          <p className={styles.videoDescription}>
                            {video.snippet.description}
                          </p>
                        </div>
                      </div>
                    ))}
                  </div>
                  {/* Video Player below the row if selected video is in this row */}
                  {isSelectedInRow && selectedVideo && (
                    <div className={styles.videoPlayerRowWrapper}>
                      <div
                        style={{
                          padding: "40px 0",
                          width: "100%",
                          display: "flex",
                          justifyContent: "center",
                          background: "#111",
                        }}
                      >
                        <iframe
                          width={isShortVideo(selectedVideo) ? "350" : "900"}
                          height={isShortVideo(selectedVideo) ? "500" : "390"}
                          src={`https://www.youtube.com/embed/${selectedVideo.id.videoId}`}
                          title={selectedVideo.snippet.title}
                          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                          allowFullScreen
                          style={{
                            maxWidth: "100%",
                            border: "none",
                            background: "#111",
                            height: isShortVideo(selectedVideo)
                              ? "500px"
                              : "390px",
                          }}
                        ></iframe>
                      </div>
                    </div>
                  )}
                </React.Fragment>
              );
            })}
          </div>
        )}

        {/* No Videos State */}
        {!loading && videos.length === 0 && (
          <div className={styles.loadingContainer}>
            <p>No videos found. Please try a different filter option.</p>
          </div>
        )}
      </div>
    </section>
  );
}

export default YoutubeVideos;
