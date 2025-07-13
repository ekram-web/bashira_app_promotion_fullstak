import React, { useEffect, useState } from "react";
import styles from "./About.module.css";
import aboutImg from "../../../assets/images/ustaz/about.JPG";
import logoMark from "../../../assets/images/Basirah Logo Full Color(Transparent).png";
import { fetchAbout } from "../../../api/about";

export default function About() {
  const [aboutData, setAboutData] = useState(null);

  useEffect(() => {
    fetchAbout()
      .then((res) => setAboutData(res.data))
      .catch(() => setAboutData(null));
  }, []);

  return (
    <section id="about" className={styles.aboutSection}>
      <div className={styles.aboutLayout}>
        <div className={styles.aboutImageBox}>
          <img
            src={
              aboutData && aboutData.image
                ? `http://localhost:8000/storage/${aboutData.image}`
                : aboutImg
            }
            alt="About Basirah"
            className={styles.aboutImage}
          />
          <div className={styles.aboutLogoOverlay}>
            <img
              src={logoMark}
              alt="Basirah Logo Mark"
              className={styles.aboutLogo}
            />
          </div>
        </div>
        <div className={styles.aboutTextBox}>
          <h1
            className={styles.aboutTitle}
            style={{ fontFamily: "'Merriweather', serif", fontWeight: "600" }}
          >
            {aboutData && aboutData.title ? aboutData.title : "WHO WE ARE"}
          </h1>
          <p
            className={styles.aboutText}
            style={{ fontFamily: "'Inter', sans-serif", fontWeight: "400" }}
          >
            {aboutData
              ? aboutData.description
              : "Basi Institute is a leading Qur'anic education platform dedicated to empowering the next generation with authentic knowledge, modern tools, and a global community. Our mission is to make learning accessible, engaging, and relevant for everyone, everywhere. We blend tradition with technology to inspire and connect students and teachers worldwide."}
          </p>
        </div>
      </div>
    </section>
  );
}
