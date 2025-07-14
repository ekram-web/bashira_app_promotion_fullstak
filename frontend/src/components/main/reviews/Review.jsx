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

function getCardsToShow() {
  if (window.innerWidth < 800) return 1;
  if (window.innerWidth < 1200) return 2;
  return 3;
}

function Review() {
  const [cardsToShow, setCardsToShow] = useState(getCardsToShow());
  const [index, setIndex] = useState(0);
  const [reviews, setReviews] = useState([]);
  const [loading, setLoading] = useState(true);
  const sliderRef = useRef(null);

  useEffect(() => {
    const handleResize = () => setCardsToShow(getCardsToShow());
    window.addEventListener("resize", handleResize);
    return () => window.removeEventListener("resize", handleResize);
  }, []);

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

  useEffect(() => {
    if (reviews.length === 0) return;
    const interval = setInterval(() => {
      setIndex((prev) => {
        if (prev < reviews.length - cardsToShow) {
          return prev + 1;
        } else {
          return 0;
        }
      });
    }, 4000);
    return () => clearInterval(interval);
  }, [cardsToShow, reviews.length]);

  // Calculate the width and transform for the sliding effect
  const sliderWidth = `${(reviews.length * 100) / cardsToShow}%`;
  const cardWidth = `${100 / reviews.length}%`;
  const translateX = `-${index * (100 / cardsToShow)}%`;

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
            <div style={{ textAlign: 'center', padding: '2rem' }}>
              Loading reviews...
            </div>
          </div>
        </div>
      </section>
    );
  }

  return (
    <section className={styles.reviewSection}>
      <h2
        className={styles.heading}
        style={{ fontFamily: "'Merriweather', serif", fontWeight: "600" }}
      >
        What People Say About Us
      </h2>
      <div
        className={styles.reviews}
        style={{
          position: "relative",
          alignItems: "center",
          overflow: "hidden",
        }}
      >
        <div
          ref={sliderRef}
          style={{
            display: "flex",
            width: sliderWidth,
            transform: `translateX(${translateX})`,
            transition: "transform 0.7s cubic-bezier(0.4,0,0.2,1)",
          }}
        >
          {reviews.map((review, idx) => (
            <div
              className={styles.reviewCard}
              key={idx}
              style={{
                flex: `0 0 ${100 / cardsToShow}%`,
                maxWidth: `${100 / cardsToShow}%`,
              }}
            >
              <img
                src={review.img ? review.img : ustazImg}
                alt={review.name}
                className={styles.avatar}
                onError={e => { e.target.onerror = null; e.target.src = ustazImg; }}
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
    </section>
  );
}

export default Review;
