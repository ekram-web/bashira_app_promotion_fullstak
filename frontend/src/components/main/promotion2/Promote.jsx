import React, { useEffect, useState } from "react";
import styles from "./promote.module.css";
import phoImg from "../../../assets/images/pho.png";
import qrImg from "../../../assets/images/qr.jpg";
import skylinkLogo from "../../../assets/skylink.svg";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
  faAppStoreIos,
  faGooglePlay,
} from "@fortawesome/free-brands-svg-icons";
import Img1 from "../../../assets/images/home.jpg";
import Img2 from "../../../assets/images/Basirah app splash page 5 copy 2@4x.png";
import Img3 from "../../../assets/images/Basirah app splash page 5 copy 6@4x.png";
import { fetchPromotions } from "../../../api/promotion";

function Promotion() {
  // Placeholder screen images (replace with real ones later)
  const screenImages = [Img1, Img2, Img3];
  const [currentScreen, setCurrentScreen] = useState(0);
  const [isRotating, setIsRotating] = useState(false);

  useEffect(() => {
    const interval = setInterval(() => {
      setIsRotating(true);
      setTimeout(() => {
        setCurrentScreen((prev) => (prev + 1) % screenImages.length);
        setIsRotating(false);
      }, 900); // match animation duration
    }, 2500);
    return () => clearInterval(interval);
  }, []);

  const [promotion, setPromotion] = useState(null);

  // Fetch promotion data from API
  useEffect(() => {
    fetchPromotions()
      .then((res) => {
        // If you expect an array, use res.data[0]
        setPromotion(Array.isArray(res.data) ? res.data[0] : res.data);
      })
      .catch(() => setPromotion(null));
  }, []);

  return (
    <section className={styles.promotionBest} id="app">
      <div className={styles.leftSection}>
        <div
          className={`${styles.frame} ${isRotating ? styles.rotate : ""}`}
          style={{ width: 220, height: 440 }}
        >
          <div className={styles.frameInner}>
            <img
              src={
                promotion && promotion.phone_image
                  ? `http://localhost:8000/storage/${promotion.phone_image}`
                  : screenImages[currentScreen]
              }
              alt="App screen"
              className={styles.frameImage}
              onError={e => { e.target.onerror = null; e.target.src = screenImages[currentScreen]; }}
            />
          </div>
        </div>
        <div className={styles.poweredBySkylink}>
          <span>Powered by</span>
          <img
            src={skylinkLogo}
            alt="Skylink logo"
            className={styles.skylinkLogo}
          />
        </div>
      </div>
      <div className={styles.promoRight}>
        <h2
          className={styles.promoHeadline}
          style={{ fontFamily: "'Merriweather', serif", fontWeight: "600" }}
        >
          {promotion ? promotion.title : "Get the Basirah App"}
        </h2>
        <div
          className={styles.promoBenefit}
          style={{ fontFamily: "'Inter', sans-serif", fontWeight: "400" }}
        >
          {promotion
            ? promotion.subtitle ||
              "Experience seamless learning and teaching—anytime, anywhere."
            : "Experience seamless learning and teaching—anytime, anywhere."}
        </div>
        <div className={styles.downloadRow}>
          <div
            style={{
              display: "flex",
              flexDirection: "column",
              alignItems: "center",
            }}
          >
            <a
              href={
                promotion ? promotion.app_store_url : "https://apps.apple.com/"
              }
              target="_blank"
              rel="noopener noreferrer"
              className={styles.promoDownloadBtn}
            >
              <FontAwesomeIcon
                icon={faAppStoreIos}
                className={styles.promoBtnIcon}
              />
              App Store
            </a>
            <div className={styles.qrContainerSmall}>
              <img
                src={
                  promotion && promotion.qr_code_image
                    ? `http://localhost:8000/storage/${promotion.qr_code_image}`
                    : qrImg
                }
                alt="Download Basirah App QR"
                className={styles.qrImageSmall}
                onError={e => { e.target.onerror = null; e.target.src = qrImg; }}
              />
              <div className={styles.qrLabelSmall}>Scan</div>
            </div>
          </div>
          <div
            style={{
              display: "flex",
              flexDirection: "column",
              alignItems: "center",
            }}
          >
            <a
              href={
                promotion ? promotion.play_store_url : "https://apps.apple.com/"
              }
              target="_blank"
              rel="noopener noreferrer"
              className={styles.promoDownloadBtn}
            >
              <FontAwesomeIcon
                icon={faGooglePlay}
                className={styles.promoBtnIcon}
              />
              Play Store
            </a>
            <div className={styles.qrContainerSmall}>
              <img
                src={
                  promotion && (promotion.qr_code_image_playstore || promotion.qr_code_image)
                    ? `http://localhost:8000/storage/${promotion.qr_code_image_playstore || promotion.qr_code_image}`
                    : qrImg
                }
                alt="Download Basirah App QR for Play Store"
                className={styles.qrImageSmall}
                onError={e => { e.target.onerror = null; e.target.src = qrImg; }}
              />
              <div className={styles.qrLabelSmall}>Scan</div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}

export default Promotion;
