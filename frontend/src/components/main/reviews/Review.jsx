import React, { useState, useEffect, useRef } from "react";
import styles from "./review.module.css";
import ustazImg from "../../../assets/images/ustaz/ustaz_k.png";
import { fetchReviews } from "../../../api/reviews";

// Fallback reviews in case API fails
const fallbackReviews = [
  {
    name: "Fatima Ali",
    role: "Student",
    text: "Basirah Institute has transformed my understanding of the Qur'an. The resources and teachers are amazing!",
    img: ustazImg,
  },
  {
    name: "Dr. Ahmed Yusuf",
    role: "Scholar",
    text: "A wonderful platform for both beginners and advanced learners. Highly recommended for anyone seeking knowledge.",
    img: ustazImg,
  },
  {
    name: "Mohammed Salim",
    role: "Parent",
    text: "My children love the interactive lessons. The app is easy to use and very educational.",
    img: ustazImg,
  },
  {
    name: "Aisha Noor",
    role: "Teacher",
    text: "The app's features make teaching so much easier and more interactive. My students are more engaged than ever!",
    img: ustazImg,
  },
  {
    name: "Omar Khalid",
    role: "Student",
    text: "I love the live classes and the supportive community. Basirah is the best!",
    img: ustazImg,
  },
  {
    name: "Layla Hassan",
    role: "Parent",
    text: "Basirah's resources are top-notch. My kids are learning so much!",
    img: ustazImg,
  },
];

// function getCardsToShow() {
//   if (window.innerWidth < 800) return 1;
//   if (window.innerWidth < 1200) return 2;
//   return 3;
// }

function getCardsToShow() {
  return window.innerWidth < 800 ? 1 : 2;
}

function Review() {
  const [cardsToShow, setCardsToShow] = useState(getCardsToShow());
  const [index, setIndex] = useState(0);
  const [reviews, setReviews] = useState([]);
  const [loading, setLoading] = useState(true);
  // const sliderRef = useRef(null);
  const intervalRef = useRef(null);

  useEffect(() => {
    const handleResize = () => setCardsToShow(getCardsToShow());
    window.addEventListener("resize", handleResize);
    return () => window.removeEventListener("resize", handleResize);
  }, []);

  // fetch reviews from API
  useEffect(() => {
    fetchReviews()
      .then((res) => {
        const transformedReviews = res.data.map((review) => ({
          name: review.name,
          role: review.role,
          text: review.text,
          img: review.image
            ? `http://localhost:8000/storage/${review.image}`
            : ustazImg,
        }));
        setReviews(transformedReviews);
        setLoading(false);
      })
      .catch(() => {
        setReviews(fallbackReviews);
        setLoading(false);
      });
  }, []);

  // useEffect(() => {
  //   if (reviews.length === 0) return;
  //   const interval = setInterval(() => {
  //     setIndex((prev) => {
  //       if (prev < reviews.length - cardsToShow) {
  //         return prev + 1;
  //       } else {
  //         return 0;
  //       }
  //     });
  //   }, 4000);
  //   return () => clearInterval(interval);
  // }, [cardsToShow, reviews.length]);

  useEffect(() => {
    // Clamp index if cardsToShow changes
    if (index > reviews.length - cardsToShow) {
      setIndex(Math.max(0, reviews.length - cardsToShow));
    }
  }, [cardsToShow, index]);

  useEffect(() => {
    startAutoSlide();
    return () => clearInterval(intervalRef.current);
  }, [cardsToShow, index]);

  const startAutoSlide = () => {
    clearInterval(intervalRef.current);
    intervalRef.current = setInterval(() => {
      handleNext();
    }, 4000);
  };

  const handlePrev = () => {
    setIndex((prev) => (prev <= 0 ? reviews.length - cardsToShow : prev - 1));
    startAutoSlide();
  };

  const handleNext = () => {
    setIndex((prev) => (prev >= reviews.length - cardsToShow ? 0 : prev + 1));
    startAutoSlide();
  };
  // // Calculate the width and transform for the sliding effect
  // const sliderWidth = `${(reviews.length * 100) / cardsToShow}%`;
  // const cardWidth = `${100 / reviews.length}%`;
  // const translateX = `-${index * (100 / cardsToShow)}%`;

  // \||||||
  // Slider width is (number of cards / cardsToShow) * 100%
  const sliderWidth = `${(reviews.length / cardsToShow) * 100}%`;
  // Each card takes up 100/reviews.length % of the visible area
  const cardWidth = `${92 / reviews.length}%`;
  // Move by one card width each time
  const translateX = `-${index * (100 / reviews.length)}%`;

  if (loading) {
    return (
      <section className={styles.reviewSection}>
        <h2
          className={styles.heading}
          style={{ fontFamily: "'Merriweather', serif", fontWeight: "600" }}
        >
          What People Say About Us
        </h2>
        <div className={styles.reviews}>
          <div className={styles.reviewCard}>
            <div style={{ textAlign: "center", padding: "2rem" }}>
              Loading reviews...
            </div>
          </div>
        </div>
      </section>
    );
  }

  return (
    <section className={styles.reviewSection}>
      <h2 className={styles.heading}>What People Say About Us</h2>
      <div className={styles.reviewsWrapper}>
        <div
          className={styles.slider}
          style={{
            width: sliderWidth,
            transform: `translateX(${translateX})`,
          }}
        >
          {reviews.map((review, idx) => (
            <div
              className={styles.reviewCard}
              key={idx}
              style={{ flex: `0 0 ${cardWidth}`, maxWidth: cardWidth }}
            >
              <img
                src={review.img ? review.img : ustazImg}
                alt={review.name}
                className={styles.avatar}
                onError={(e) => {
                  e.target.onerror = null;
                  e.target.src = ustazImg;
                }}
              />
              <p className={styles.text}>&ldquo;{review.text}&rdquo;</p>
              <div className={styles.reviewer}>
                <span className={styles.name}>{review.name}</span>
                <span className={styles.role}>{review.role}</span>
              </div>
            </div>
          ))}
        </div>
      </div>
      // Navigation arrows
      <div className={styles.arrowDiv}>
        <button
          className={`${styles.arrowBtn} ${styles.leftArrow}`}
          onClick={handlePrev}
          aria-label="Previous reviews"
        >
          &#8592;
        </button>
        <button
          className={`${styles.arrowBtn} ${styles.rightArrow}`}
          onClick={handleNext}
          aria-label="Next reviews"
        >
          &#8594;
        </button>
      </div>
    </section>
  );
}

export default Review;
