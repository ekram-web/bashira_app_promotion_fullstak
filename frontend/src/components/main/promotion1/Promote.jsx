import React , { useEffect, useState } from "react";
import styles from "./promote.module.css";
import phoImg from "../../../assets/images/pho.png";
import qrImg from "../../../assets/images/qr.jpg";
import skylinkLogo from "../../../assets/skylink.svg";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faAppStoreIos } from "@fortawesome/free-brands-svg-icons";
import { fetchPromotions } from '../../../api/promotion';


function Promotion() {

  const [promotion, setPromotion] = useState(null);

  useEffect(() => {
    fetchPromotions ()
      .then(res => {
        // If you expect an array, use res.data[0]
        setPromotion(Array.isArray(res.data) ? res.data[0] : res.data);
      })
      .catch(() => setPromotion(null));
  }, []);

  return (
    <section className={styles.promotionBest} id="app">
      <div
        style={{
          display: "flex",
          flexDirection: "column",
          alignItems: "center",
        }}
      >
        <img
          src={phoImg}
          alt="Basirah App on Phone"
          className={styles.phoneImageBest}
        />
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
      <h2 className={styles.promoHeadline}>
          {promotion ? promotion.title : "Get the Basirah App"}
        </h2>
        <div className={styles.promoBenefit}>
          {promotion
            ? promotion.subtitle || "Experience seamless learning and teaching—anytime, anywhere."
            : "Experience seamless learning and teaching—anytime, anywhere."}
        </div>
        <div className={styles.downloadRow}>
          <a
            href={promotion ? promotion.app_store_url : "https://apps.apple.com/"}
            target="_blank"
            rel="noopener noreferrer"
            className={styles.promoDownloadBtn}
          >
            <FontAwesomeIcon
              icon={faAppStoreIos}
              className={styles.promoBtnIcon}
            />
            Download on App Store
          </a>
          <div className={styles.qrContainerSmall}>
          <img
              src={
                promotion && promotion.qr_code_image
                  ? `http://localhost:8000/storage/${promotion.qr_code_image}`
                  : ""
              }
              alt="Download Basirah App QR"
              className={styles.qrImageSmall}
            />
            <div className={styles.qrLabelSmall}>Scan</div>
          </div>
        </div>
      </div>
    </section>
  );
}

export default Promotion;
