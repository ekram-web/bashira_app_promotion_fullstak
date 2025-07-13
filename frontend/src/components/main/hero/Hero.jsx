import React, { useState, useEffect, useRef } from "react";
import styles from "./Hero.module.css";
import quranImg from "../../../assets/images/quran.png";
import { fetchHero } from "../../../api/hero";

// Fallback slides in case API fails
const fallbackSlides = [
  {
    title: "Empower Your Qur'anic Journey",
    subtitle:
      "Learn, connect, and grow with Basirah Institute's modern tools and global community.",
    background_gradient: "linear-gradient(120deg, #042048 60%, #01AD88 100%)",
    image: null,
  },
  {
    title: "Expert Teachers, Authentic Resources",
    subtitle:
      "Access certified scholars, interactive lessons, and a supportive learning environment—anytime, anywhere.",
    background_gradient: "linear-gradient(120deg, #042048 60%, #01AD88 100%)",
    image: null,
  },
  {
    title: "Interactive Learning, Real Progress",
    subtitle:
      "Track your Qur'anic studies, join live classes, and connect with a global community—all in one app.",
    background_gradient: "linear-gradient(120deg, #042048 60%, #01AD88 100%)",
    image: null,
  },
];

function Hero() {
  const [slides, setSlides] = useState(fallbackSlides);
  const [loading, setLoading] = useState(true);
  const [current, setCurrent] = useState(0);
  const [vertical, setVertical] = useState(false);
  const timeoutRef = useRef(null);
  const [textFade, setTextFade] = useState("textFadeIn");

  useEffect(() => {
    fetchHero()
      .then((res) => {
        console.log('Hero API response:', res.data);
        if (res.data && res.data.length > 0) {
          setSlides(res.data);
        } else {
          setSlides(fallbackSlides);
        }
        setLoading(false);
      })
      .catch((error) => {
        console.error('Hero API error:', error);
        setSlides(fallbackSlides);
        setLoading(false);
      });
  }, []);

  useEffect(() => {
    if (slides.length === 0) return;
    
    timeoutRef.current = setTimeout(() => {
      setTextFade("textFadeOut");
      setVertical(true);
      setTimeout(() => {
        setCurrent((prev) => (prev + 1) % slides.length);
        setVertical(false);
        setTextFade("textFadeIn");
      }, 1200); // duration of vertical slide and fade
    }, 3000); // interval between slides
    return () => clearTimeout(timeoutRef.current);
  }, [current, slides.length]);

  if (loading) {
    return (
      <section
        id="hero"
        className={styles.heroRedesign}
        style={{ background: "linear-gradient(120deg, #042048 60%, #01AD88 100%)" }}
      >
        <div className={styles.heroText} style={{ textAlign: "left" }}>
          <h1
            className={styles.heroTitle}
            style={{ fontFamily: "'Merriweather', serif", fontWeight: "600" }}
          >
            Loading...
          </h1>
        </div>
        <div className={styles.heroImageBox}>
          <img 
            src={quranImg}
            alt="Basirah App"
            className={styles.heroImage}
          />
        </div>
      </section>
    );
  }

  const slide = slides[current];
  
  console.log('Current slide:', slide);
  console.log('Slide image value:', slide.image);
  console.log('Image condition result:', slide.image && slide.image.trim() !== "");

  // to get the fist imgae
  const firstImage = slides[0]?.image;

  return (
    <section
      id="hero"
      className={styles.heroRedesign}
      style={{ background: slide.background_gradient || slide.bg || "linear-gradient(120deg, #042048 60%, #01AD88 100%)" }}
    >
      <div className={styles.heroText} style={{ textAlign: "left" }}>
        <h1
          key={slide.title}
          className={styles.heroTitle + " " + styles[textFade]}
          style={{ fontFamily: "'Merriweather', serif", fontWeight: "600" }}
        >
          {slide.title}
        </h1>
        <p
          key={slide.subtitle}
          className={styles.heroSubtitle + " " + styles[textFade]}
          style={{ fontFamily: "'Inter', sans-serif", fontWeight: "400" }}
        >
          {slide.subtitle}
        </p>
      </div>
      <div className={styles.heroImageBox}>
        {/* <div className={styles.heroImageGlow}></div> */}
        <img 
          // src={
          //   slide.image && slide.image.trim() !== ""
          //     ? `http://localhost:8000/storage/${slide.image}`
          //     : quranImg
          // }
          
          src={
            firstImage && firstImage.trim() !== ""
              ? `http://localhost:8000/storage/${firstImage}`
              : quranImg
          }
          alt="Basirah App on Phone"
          className={
            styles.heroImage +
            " " +
            (vertical ? styles.slideUp : styles.slideDown)
          }
        />
      </div>
    </section>
  );
}

export default Hero;
