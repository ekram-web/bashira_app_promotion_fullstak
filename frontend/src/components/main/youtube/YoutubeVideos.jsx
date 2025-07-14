import React, { useEffect, useState } from "react";
import { FaPlay } from "react-icons/fa";
import styles from "./Youtube.module.css";
import { fetchYoutubeVideos } from '../../../api/youtube';

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
    fetchYoutubeVideos()
      .then((res) => {
        setVideos(res.data.slice(0, 6)); // Limit to 6 videos
        setLoading(false);
      })
      .catch(() => setLoading(false));
  }, []);

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
                row.some((v) => v.id === selectedVideo.id);
              return (
                <React.Fragment key={rowIndex}>
                  <div className={styles.videoGrid}>
                    {row.map((video) => (
                      <div
                        key={video.id}
                        className={`${styles.videoCard} ${
                          selectedVideo && selectedVideo.id === video.id
                            ? styles.selected
                            : ""
                        }`}
                        onClick={() => setSelectedVideo(video)}
                      >
                        <div className={styles.videoThumbnail}>
                          <img src={video.thumbnail} alt={video.title} />
                          <div className={styles.playButton}>
                            <FaPlay className={styles.playIcon} />
                          </div>
                        </div>
                        <div className={styles.videoInfo}>
                          <h3 className={styles.videoTitle}>{video.title}</h3>
                          <p className={styles.videoDescription}>
                            {video.description}
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
                          position: "relative"
                        }}
                      >
                        <button
                          className={styles.closeButton}
                          style={{
                            position: "absolute",
                            top: 10,
                            right: 10,
                            zIndex: 2
                          }}
                          onClick={handleCloseVideo}
                          aria-label="Close video"
                        >
                          ×
                        </button>
                        <iframe
                          width="900"
                          height="390"
                          src={`https://www.youtube.com/embed/${selectedVideo.id}`}
                          title={selectedVideo.title}
                          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                          allowFullScreen
                          style={{
                            maxWidth: "100%",
                            border: "none",
                            background: "#111",
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


